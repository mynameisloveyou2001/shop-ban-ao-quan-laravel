để file hepler.php được dùng chung thì ta vô file composer.jon tìm chỗ 
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    },




    sau đó thêm dòng sau
        "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        },
        "files":[
            "app/helpers/Helper.php"
        ]
    },

    rồi ra terminal chạy lệnh composer dump-autoload
