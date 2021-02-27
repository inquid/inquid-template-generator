<?php
namespace yiiforces\inquidTemplateGenerator;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\gii\CodeFile;

/**
 * This generator will generate the skeleton files needed by an extension.
 *
 * @property bool $outputPath The directory that contains the module class. This property is read-only.
 *
 * @author Flavio E. Salas M. <salas.flavio@gmail.com>
 */
class Generator extends \yii\gii\Generator
{
    // defaults values..
    public $githubUserAccount = 'inquid';
    public $changeLogDiff     = '1902cc2';
    public $outputPath        = '@app/runtime/inquid';
    public $packageName       = 'php-library-template';
    public $namespace         = 'Inquid\\Library\\';
    public $authorEmail       = 'luisarmando1234@gmail.com';
    public $authorName        = 'Luis Gonzalez';
    public $description       = 'Provides a GitHub repository template for a PHP library, using GitHub actions.';
    public $license           = 'MIT';
    public $type              = 'library';

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Inquid Template Generator';
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return 'This generator helps you to generate the files needed by ergebnis/php-library-template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules() , [
            // githubUserAccount
            [['githubUserAccount'], 'required'],
            [['githubUserAccount'], 'filter', 'filter'  => 'trim'],
            [['githubUserAccount'], 'match' , 'pattern' => '/^[a-z0-9\-\.]+$/', 'message' => 'Only lowercase word characters, dashes and dots are allowed.'],

            // githubUserAccount
            [['changeLogDiff'], 'required'],
            [['changeLogDiff'], 'filter', 'filter'  => 'trim'],
            [['changeLogDiff'], 'match' , 'pattern' => '/^[a-z0-9]+$/', 'message' => 'Only lowercase word characters, dashes and dots are allowed.'],

            // packageName
            [['packageName'], 'required'],
            [['packageName'], 'filter', 'filter'  => 'trim'],
            [['packageName'], 'match' , 'pattern' => '/^[a-z0-9\-\.]+$/', 'message' => 'Only lowercase word characters, dashes and dots are allowed.'],

            // namespace
            [['namespace'], 'required'],
            [['namespace'], 'filter', 'filter'  => 'trim'],
            [['namespace'], 'match', 'pattern' => '/^[a-zA-Z0-9_\\\]+\\\$/', 'message' => 'Only letters, numbers, underscores and backslashes are allowed. PSR-4 namespaces must end with a namespace separator.' ],

            // authorEmail
            [['authorEmail'], 'required'],
            [['authorEmail'], 'email'],
            [['authorEmail'], 'filter', 'filter'  => 'trim'],

            // authorName
            [['authorName'], 'required'],
            [['authorName'], 'filter', 'filter'  => 'trim'],

            // description
            [['description'], 'required'],
            [['description'], 'filter', 'filter'  => 'trim'],

            // license
            [['license'], 'required'],
            [['license'], 'filter', 'filter' => 'trim'],
            [['license'], 'in',     'range'  => array_keys( static::optsLicense() )],

            // type
            [['type'], 'required'],
            [['type'], 'filter', 'filter' => 'trim'],
            [['type'], 'in',     'range'  => array_keys( static::optsType() )],

            // outputPath
            [['outputPath'], 'required'],
            [['outputPath'], 'filter', 'filter'  => 'trim'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'githubUserAccount' => 'Github user account',
            'changeLogDiff'     => 'Change log diff',
            'packageName'       => 'Package Name',
            'license'           => 'License',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function hints()
    {
        return [
            'githubUserAccount' => 'This refers to the name of the publisher, eg. <code>myself</code>.',
            'changeLogDiff'     => 'This refers last commit to diff (CHANGELOG.md).',
            'outputPath'        => 'The temporary location of the generated files.',
            'packageName'       => 'This is the name of the extension on packagist, eg. <code>yii2-foobar</code>.',
            'namespace'         => 'PSR-4, eg. <code>myself\foobar\</code> This will be added to your autoloading by composer. Do not use yii, yii2 or yiisoft in the namespace.',
            'description'       => 'A sentence or subline describing the main purpose of the extension.',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function stickyAttributes()
    {
        return ['githubUserAccount', 'authorName', 'authorEmail'];
    }

    /**
     * {@inheritdoc}
     */
    public function successMessage()
    {
        return '<p><em>The extension has been generated successfully.</em></p>';
    }

    /**
     * {@inheritdoc}
     */
    public function requiredTemplates()
    {
        return [
            'composer.json',
            '_README.md',
            'composer-require-checker.json',
            'gitattributes',
            'editorconfig',
            'gitignore',
            'gitpod.Dockerfile',
            'gitpod.yml',
            '.php_cs',
            '.yamllint.yaml',
            'CHANGELOG.md',
            'infection.json',
            'LICENSE.md',
            'Makefile',
            'psalm.xml',
            'psalm-baseline.xml',
            'phpstan.neon',
            'phpstan-baseline.neon',
            'Unit/ExampleTest.php',
            'Unit/phpunit.xml',
            'Integration/phpunit.xml',
            'test/AutoReview/phpunit.xml',
            'test/AutoReview/SrcCodeTest.php',
            'src/Example.php',
            '_github/FUNDING.yml',
            '_github/CODEOWNERS',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $files = [];
        $modulePath = $this->getOutputPath();
        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/composer.json',
            $this->render('composer.json')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/README.md',
            $this->render('_README.md')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/composer-require-checker.json',
            $this->render('composer-require-checker.json')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/.gitattributes',
            $this->render('gitattributes')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/.editorconfig',
            $this->render('editorconfig')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/.gitignore',
            $this->render('gitignore')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/.gitpod.Dockerfile',
            $this->render('gitpod.Dockerfile')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/.gitpod.yml',
            $this->render('gitpod.yml')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/.php_cs',
            $this->render('.php_cs')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/.yamllint.yaml',
            $this->render('.yamllint.yaml')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/CHANGELOG.md',
            $this->render('CHANGELOG.md')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/infection.json',
            $this->render('infection.json')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/LICENSE.md',
            $this->render('LICENSE.md')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/Makefile',
            $this->render('Makefile')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/psalm.xml',
            $this->render('psalm.xml')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/psalm-baseline.xml',
            $this->render('psalm-baseline.xml')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/phpstan.neon',
            $this->render('phpstan.neon')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/phpstan-baseline.neon',
            $this->render('phpstan-baseline.neon')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/Unit/ExampleTest.php',
            $this->render('Unit/ExampleTest.php')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/Unit/phpunit.xml',
            $this->render('Unit/phpunit.xml')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/Integration/phpunit.xml',
            $this->render('Integration/phpunit.xml')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/test/AutoReview/phpunit.xml',
            $this->render('test/AutoReview/phpunit.xml')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/test/AutoReview/SrcCodeTest.php',
            $this->render('test/AutoReview/SrcCodeTest.php')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/src/Example.php',
            $this->render('src/Example.php')
        );


        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/.github/FUNDING.yml',
            $this->render('_github/FUNDING.yml')
        );

        $files[] = new CodeFile(
            $modulePath . '/' . $this->packageName . '/.github/CODEOWNERS',
            $this->render('_github/CODEOWNERS')
        );

        FileHelper::copyDirectory(dirname(__FILE__) . '/staticFiles/github/', Yii::getAlias($this->outputPath) . '/' . $this->packageName . '/.github');
        FileHelper::copyDirectory(dirname(__FILE__) . '/staticFiles/phive/' , Yii::getAlias($this->outputPath) . '/' . $this->packageName . '/.phive');

        return $files;
    }

    /**
     * @return bool the directory that contains the module class
     */
    public function getOutputPath()
    {
        return Yii::getAlias(str_replace('\\', '/', $this->outputPath));
    }

    /**
     * @return array options for type drop-down
     */
    public static function optsType()
    {
        $types = [
            'yii2-extension',
            'library',
        ];

        return array_combine($types, $types);
    }

    /**
     * @return array options for license drop-down
     */
    public static function optsLicense()
    {
        $licenses = [
            'Apache-2.0',
            'BSD-2-Clause',
            'BSD-3-Clause',
            'BSD-4-Clause',
            'GPL-2.0',
            'GPL-2.0+',
            'GPL-3.0',
            'GPL-3.0+',
            'LGPL-2.1',
            'LGPL-2.1+',
            'LGPL-3.0',
            'LGPL-3.0+',
            'MIT'
        ];

        return array_combine($licenses, $licenses);
    }
}
