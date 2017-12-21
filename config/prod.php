<?php

// configure your app for the production environment
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Symfony\Component\Security\Core\Encoder\PlaintextPasswordEncoder;


$app['twig.path'] = array(__DIR__.'/../templates');
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');

$app->register(
    new Silex\Provider\DoctrineServiceProvider(),
    [
        'db.options' => [
            'driver'   => 'pdo_mysql',
            'dbname'   => 'lux',
            'host'     => 'localhost',
            'user'     => 'root',
            'password' => ''
        ]
    ]
);

$app->register(
    new DoctrineOrmServiceProvider(),
    [
        'orm.proxies.dir' => sys_get_temp_dir(),
        'orm.em.options' => [
            'mappings' => [
                [
                    'type' => 'annotation',
                    'namespace' => 'Models',
                    'path' => __DIR__.'/../src/Models'
                ]
            ]
        ]
    ]
);



$app->register(
    new SecurityServiceProvider(),
    [
        'security.firewalls' => [                           // firewalls definition
            'firewall_named_admin' => [                     // firewall name
                'pattern' => '^/',                     // firewall scope
                'anonymous' => true,                             // pure http authentication system
                'users' => function() use ($app) {
                    $repository = $app['orm.em']->getRepository(Models\UserModel::class);
                    return new \Provider\DBUserProvider($repository);
                },
                'logout' => [
                    'logout_path' => '/admin/logout',
                    'invalidate_session' => true,
                    'target_url' => '/login'
                ],
                'form' => [
                    'login_path' => '/login',
                    'check_path' => '/admin/login_check',
                    'default_target_path' => '/user/account',
                    'always_use_default_target_path' => true
                ]
            ]
        ],
        'security.default_encoder' => function ($app) {
            return $app['security.encoder.bcrypt'];
        },
        'security.role_hierarchy' => [                          // Role hierarchy definition
            'ROLE_SUPER_ADMIN' => ['ROLE_ADMIN'],               // ROLE_SUPER_ADMIN is upper than ROLE_ADMIN ad ROLE_USER
            'ROLE_ADMIN' => ['ROLE_USER']
        ],
        'security.access_rules' => [
            ['^/admin', 'ROLE_ADMIN'],
            ['^/(user|article)', 'ROLE_USER']   // probleme a regler pour que seul les enregistrer ont le droit de creer des articles
        ]
    ]
);

$app->register(new Silex\Provider\SessionServiceProvider());

// Add validation system
$app->register(new Silex\Provider\ValidatorServiceProvider());
// Add form system
$app->register(new Silex\Provider\FormServiceProvider());
// Add CSRF(cross site request forgery) protection system
$app->register(new Silex\Provider\CsrfServiceProvider());

$app['locale'] = 'en_en';
$app->register(
    new Silex\Provider\TranslationServiceProvider(),
    [
        'translator.domains' => []
    ]
);
