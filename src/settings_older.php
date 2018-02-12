<?php
return [
    'settings' => [
        'test' => 1,
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'database' => [
            //Pode se passar varias conexoes em varios servidores
            'mongodb' => [
                'default' =>
                [
                    'uri' => '192.168.1.156',
                    'porta' => '27017',
                    'user' => 'gpd',
                    'password' => 'gpd1g1t4ldb!'
                ],
                'localhost' =>
                [
                    'uri' => 'localhost',
                    'porta' => '27017',
                    'user' => '',
                    'password' => ''
                ],
            ],
            'postgres' => []
        ],
        'rabbitmq' => [
            'host' => 'localhost',
            'port' => '5672',
            'user' => 'guest',
            'pass' => 'guest',
        ],
        'security' => [
            'type' => 'jwt',
            'status' => 0,
            'appkey' => 'mccREDVo0GiECFL3H5TFKOmUKIp3P96c2TWeD9RP7E1lSOKU8mMTuCjRff0SZ0ZUtU41RO3eqj6pg9jNuC24ljg2bN5KE6fe3PnU6gRemskHwYC9mBNIwAIsJ1oocH4rvrcou941nYKWp5HMvt92Bjq1yYBV5qnDwXRyYa7oJ4iHEoU3a54cA16txGR56Fq4RvexHevmVyv4qaGMHORqVF1fxNvFDANHRwW7cTyR4Yvtt6f5wC6nTAUnEtkx5V9usZybnNukS9bhTYHDLOGYpRHxWCB3SWMYyciwvmwAzB0rvWX4xg1sBcXJR0kETTqhLXQe9pt9UTIXXU42V7QkrLC1tSFrYsvDySl9OEpCXDYkCA13ul7yZf1rP4nADtcnhFBeATOX3TRwQNrekzXTqEM6xQKllmWe8BvrCTqCJJVY4mLFcvJaQuIrF3bTmZ5y4XbJijNQfx0VpySRekPDZL0klFglznrj3KJuEA6aILLTfrJ3r9Uc5Gna5TClGUfM',
            'encryptType' => 'sha256',
            'exp' => 120
        ],
        'keys' => [
            'google' => [
                'key' => '763951894365-no315l1o23ul0jlqrj29609l9rph88g4.apps.googleusercontent.com',
                'config' => '{"installed":{"client_id":"763951894365-no315l1o23ul0jlqrj29609l9rph88g4.apps.googleusercontent.com","project_id":"gpd-cc","auth_uri":"https://accounts.google.com/o/oauth2/auth","token_uri":"https://accounts.google.com/o/oauth2/token","auth_provider_x509_cert_url":"https://www.googleapis.com/oauth2/v1/certs","client_secret":"Pxadn4n1U--j8kxCK-Biwz51","redirect_uris":["urn:ietf:wg:oauth:2.0:oob","http://localhost"]}}'
            ],
            'facebook' => [
                'appid' => '193416274398799',
                'appsecret' => '2923c2238feadf571e6a0f24ae87dfb7'
            ]
        ],
        'mailgun' => [
            'key' => 'key-0cba780c92884bea503796ceb8cb9914',
            'domain' => 'mg.gpdtecnologia.com.br',
            'defaultFrom' => 'contato@mg.gpdgecnologia.com.br'
        ],
        'file' => [
            'path' => [
                'image' => [
                    'local_fisico' => '/public/images/',
                    'url' => 'http://'.$_SERVER['HTTP_HOST'].'/images/'
                ],
                'image/video'=> [
                    'local_fisico' => '/public/images/',
                    'url' => 'http://'.$_SERVER['HTTP_HOST'].'/imagevideos/'
                ],
                'protocolo'=> [
                    'local_fisico' => '/public/files/',
                    'url' => 'http://'.$_SERVER['HTTP_HOST'].'/files/'
                ],
                'public'=> ''
            ],
            'ext' => [
                'image' => ['image/jpeg','image/pjpeg','image/png'],
                'video' => [
                    'application/x-troff-msvideo',
                    'video/avi',
                    'video/msvideo',
                    'video/x-msvideo',
                    'video/avs-video',
                    'video/mp4',
                    'video/mpeg'
                ],
                'image/video' => [
                    'image/jpeg',
                    'image/pjpeg',
                    'image/png',
                    'application/x-troff-msvideo',
                    'video/avi',
                    'video/msvideo',
                    'video/x-msvideo',
                    'video/avs-video',
                    'video/mp4',
                    'video/mpeg'
                ],
                'protocolo' => [
                    'image/jpeg',
                    'image/pjpeg',
                    'image/png',
                    'image/bmp',
                    'image/gif',
                    'image/tiff',
                    'image/x-tiff',
                    'application/x-troff-msvideo',
                    'video/avi',
                    'video/msvideo',
                    'video/x-msvideo',
                    'video/avs-video',
                    'video/mp4',
                    'video/mpeg',
                    'video/quicktime',
                    'application/pdf',
                    'application/msword',
                    'application/mspowerpoint',
                    'application/vnd.ms-powerpoint',
                    'application/mspowerpoint',
                    'application/powerpoint',
                    'application/vnd.ms-powerpoint',
                    'application/x-mspowerpoint',
                    'application/wordperfect',
                    'application/x-wpwin',
                    'application/vnd.oasis.opendocument.text ',
                    'application/vnd.oasis.opendocument.text-template',
                    'application/vnd.oasis.opendocument.text-master',
                    'application/vnd.oasis.opendocument.graphics',
                    'application/vnd.oasis.opendocument.presentation',
                    'application/vnd.oasis.opendocument.graphics-template',
                    'application/vnd.oasis.opendocument.presentation',
                    'application/vnd.oasis.opendocument.presentation-template',
                    'application/vnd.oasis.opendocument.spreadsheet',
                    'application/vnd.oasis.opendocument.spreadsheet-template',
                    'application/vnd.oasis.opendocument.chart',
                    'application/vnd.oasis.opendocument.formula',
                    'application/vnd.oasis.opendocument.image',
                    'application/vnd.sun.xml.writer',
                    'application/vnd.sun.xml.writer.template',
                    'application/vnd.sun.xml.calc',
                    'application/vnd.sun.xml.calc.template',
                    'application/vnd.sun.xml.draw',
                    'application/vnd.sun.xml.draw.template',
                    'application/vnd.sun.xml.impress',
                    'application/vnd.sun.xml.impress.template',
                    'application/vnd.sun.xml.writer.global',
                    'application/vnd.sun.xml.math',
                    'application/vnd.stardivision.writer',
                    'application/vnd.stardivision.writer-global',
                    'application/vnd.stardivision.calc',
                    'application/vnd.stardivision.draw',
                    'application/vnd.stardivision.impress',
                    'application/vnd.stardivision.impress-packed',
                    'application/vnd.stardivision.math',
                    'application/vnd.stardivision.chart',
                    'application/vnd.stardivision.mail',
                    'application/x-starwriter',
                    'application/x-starcalc',
                    'application/x-stardraw',
                    'application/x-starimpress',
                    'application/x-starmath',
                    'application/x-starchart',
                    'text/richtext',
                    'application/x-rtf',
                    'application/rtf',
                    'text/plain',
                    'application/excel',
                    'application/vnd.ms-excel',
                    'application/x-excel',
                    'application/x-msexcel',
                    'application/xml',
                    'application/x-compressed',
                    'application/x-zip-compressed',
                    'application/zip',
                    'multipart/x-zip',
                    'application/x-rar-compressed',
                    'application/octet-stream',
                    'application/xml',
                    'text/xml',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.ms-word.document.macroEnabled.12',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
                    'application/vnd.ms-word.template.macroEnabled.12',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/vnd.ms-excel.sheet.macroEnabled.12',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
                    'application/vnd.ms-excel.template.macroEnabled.12',
                    'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
                    'application/vnd.ms-excel.addin.macroEnabled.12',
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                    'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
                    'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
                    'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
                    'application/vnd.openxmlformats-officedocument.presentationml.template',
                    'application/vnd.ms-powerpoint.template.macroEnabled.12',
                    'application/vnd.ms-powerpoint.addin.macroEnabled.12',
                    'application/vnd.openxmlformats-officedocument.presentationml.slide',
                    'application/vnd.ms-powerpoint.slide.macroEnabled.12',
                    'application/vnd.ms-officetheme',
                    'application/onenote'
                ]
            ]
        ]
    ],
];
