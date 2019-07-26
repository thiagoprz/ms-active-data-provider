Yii SQL Server Active Data Provider
==
This package contains an Active Data Provider to be used instead of Yii 1 builtin CActiveDataProvider to fix the "weird" pagination when using a MS Sql Server database in the Active Records classes.


Installation and Usage
--
Basically you just need to download this package and put MSActiveDataProvider in the application.components folder (by default: protected/components). 
After that you may use it in any CModel based class, for instance replacing any call of CActiveDataProvider for MSActiveDataProvider.

Example
--
You can check the [User model sample](/example/User.php).
