'use strict';
var EntityPrompt = require('./entity/prompts');
const chalk = require('chalk');

class GeneratorSymfony extends EntityPrompt {

    askClass() 
    {
        this.prompt([{
            type: 'confirm',
            name: 'newClass',
            message: 'Do you want create a new entity: ',
            store: true
        }]).then((answers) => {
            if (answers.newClass) {
                this.askForNewEntity.call(this);
            }
        });
    }

    askForNewApp() 
    {
        var fs = require('fs');
        this.prompt([{
            type: 'input',
            name: 'appName',
            message: 'What is the application\'s name: ',
            validate: function (input) {
                if (!/^[a-zA-Z\-0-9_]+$/.exec(input)) {
                    return "Invalid Directory Name!";
                }
                if (fs.existsSync('./' + input)) {
                    return "Directory already exists!";
                }
                return true;
            }
        },{
            when: response => response.appName !== '',
            type: 'list',
            name: 'dbType',
            message: 'What is the database used: ',
            default: 'postgresql',
            choices:[{
                name: 'Mysql',
                value: 'PDOMySql'
            },{
                name: 'PostgreSQL',
                value: 'PDOPgSql'
            },{
                name: 'Oracle',
                value: 'PDOOracle'
            }/* ,{
                name: 'MS SQL',
                value: 'PDOSqlsrv'
            } */
            ]
        }/* ,{
            type: 'input',
            name: 'dbHost',
            message: 'What is database Host: ',
        } */,{
            type: 'input',
            name: 'dbPort',
            message: 'What is database Port: ',
            default: function (response){
                if(response.dbType === 'PDOMySql'){
                    return '3306';
                }else if(response.dbType === 'PDOPgSql'){
                    return '5432';
                }else if(response.dbType === 'PDOOracle'){
                    return '1521';
                }/* else if(response.dbType === 'PDOSqlsrv'){
                    return '1433';
                } */
                return '';
            }
        },{
            type: 'input',
            name: 'dbName',
            message: 'What is database Name: ',
            default: function(response){
                if(response.dbType === 'PDOMySql'){
                    return 'mysql';
                }else if(response.dbType === 'PDOPgSql'){
                    return 'postgres';
                }else if(response.dbType === 'PDOOracle'){
                    return 'oracle';
                }/* else if(response.dbType === 'PDOSqlsrv'){
                    return '1433';
                } */
            }
        },{
            type: 'input',
            name: 'dbUser',
            message: 'What is database User: ',
            default: function(response){
                if(response.dbType === 'PDOMySql'){
                    return 'root';
                }else if(response.dbType === 'PDOPgSql'){
                    return 'postgres';
                }else if(response.dbType === 'PDOOracle'){
                    return 'oracle';
                }/* else if(response.dbType === 'PDOSqlsrv'){
                    return '1433';
                } */
            }
        },{
            type: 'password',
            name: 'dbPassword',
            message: 'What is database Password: ',
        }
    ]).then((answers) => {
            var context = this;
            console.log('Wait creating skeloton zend application...');
            this.createSkelotonApplitaion(answers);
        });
    }

    createSkelotonApplitaion(props)
    {
        var fs = require('fs');
        if (!fs.existsSync(props.appName)) {
            //docker-compose
            if(props.dbType === 'PDOMySql'){
                this.writeFileSkeleton('backend/files/mysql/docker-compose.yml', props.appName+'/docker-compose.yml', {props: props});
                this.writeFileSkeleton('backend/files/oracle/Dockerfile', props.appName+'/Dockerfile', {props: props});
            }else if(props.dbType === 'PDOPgSql'){
                this.writeFileSkeleton('backend/files/postgres/docker-compose.yml', props.appName+'/docker-compose.yml', {props: props});
                this.writeFileSkeleton('backend/files/postgres/Dockerfile', props.appName+'/Dockerfile', {props: props});
            }else {
                this.writeFileSkeleton('backend/files/oracle/docker-compose.yml', props.appName+'/docker-compose.yml', {props: props});
                this.writeFileSkeleton('backend/files/oracle/Dockerfile', props.appName+'/Dockerfile', {props: props});
            }
            this.writeFileSkeleton('backend/skeleton', props.appName, {props: props});
            this.writeFileSkeleton('backend/skeleton/config/autoload/doctrine_orm.global.php', 
            props.appName+'/config/autoload/doctrine_orm.global.php', {props: props});
            this.writeFileSkeleton('backend/files/_.htaccess', 
            props.appName+'/public/.htaccess', {props: props});
            this.writeFileSkeleton('frontend/skeleton', props.appName+'/client', {props: props});
            this.writeFileSkeleton('frontend/files/_.angular-cli.json', 
            props.appName+'/client/_.angular-cli.json', {props: props});
            console.log('\n Now you need follow the steps for de run your application symfony');
            console.log('\n Step - 1: Entry into the directory '+props.appName+' with command '+chalk.blue('cd '+props.appName));
            console.log('\n Step - 2: Execute the download of the dependencies with the command '+chalk.blue('composer install'));
            console.log('\n Step - 3: Create or import your entities with the command '+chalk.blue(' yo zf-restful-crud'));
        }
    }

    writeFileSkeleton(to, from, params)
    {
        this.fs.copyTpl(
            this.templatePath(to),
            this.destinationPath(from), 
            params
        );
    }
}

module.exports = class extends GeneratorSymfony 
{    
    constructor(args, opts) {
        super(args, opts);
        this.log('Initializing...');
    }
    
    start() {
        const done = this.async();
        this.prompt([{
            type: 'confirm',
            name: 'checkApp',
            message: 'The application already exist: ',
        }]).then((answers) => {
            if (answers.checkApp) {
                this.askForNewEntity.call(this);
            } else {
                this.askForNewApp();
            }
            done();
        });
    }
};