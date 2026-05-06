<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

```
eHealthCampus
├─ .editorconfig
├─ app
│  ├─ Http
│  │  ├─ Controllers
│  │  │  ├─ AdminController.php
│  │  │  ├─ AuthController.php
│  │  │  ├─ Controller.php
│  │  │  ├─ DashboardController.php
│  │  │  ├─ HealthRecordController.php
│  │  │  ├─ LoginController.php
│  │  │  ├─ MedicalRecordController.php
│  │  │  ├─ ProfileController.php
│  │  │  ├─ SleepController.php
│  │  │  └─ SuperAdminController.php
│  │  └─ Middleware
│  │     └─ RoleMiddleware.php
│  ├─ Models
│  │  ├─ HealthRecord.php
│  │  ├─ SleepRecord.php
│  │  └─ User.php
│  └─ Providers
│     └─ AppServiceProvider.php
├─ artisan
├─ bootstrap
│  ├─ app.php
│  ├─ cache
│  │  ├─ packages.php
│  │  └─ services.php
│  └─ providers.php
├─ composer.json
├─ composer.lock
├─ config
│  ├─ app.php
│  ├─ auth.php
│  ├─ cache.php
│  ├─ database.php
│  ├─ filesystems.php
│  ├─ logging.php
│  ├─ mail.php
│  ├─ queue.php
│  ├─ services.php
│  └─ session.php
├─ database
│  ├─ database.sqlite
│  ├─ factories
│  │  └─ UserFactory.php
│  ├─ migrations
│  │  ├─ 0001_01_01_000000_create_users_table.php
│  │  ├─ 2026_04_05_080148_create_health_records_table.php
│  │  ├─ 2026_04_16_202631_add_columns_to_health_records_table.php
│  │  ├─ 2026_04_16_203051_remove_record_date_from_health_records_table.php
│  │  ├─ 2026_04_16_203626_fix_status_column_in_health_records.php
│  │  ├─ 2026_04_18_064425_create_sleep_records_table.php
│  │  ├─ 2026_04_18_070717_add_date_to_sleep_records_table.php
│  │  ├─ 2026_04_27_103059_add_role_to_users_table.php
│  │  └─ 2026_04_27_fix_nullable_tb_bb.php
│  └─ seeders
│     └─ DatabaseSeeder.php
├─ ehealth_db
├─ package.json
├─ phpunit.xml
├─ public
│  ├─ .htaccess
│  ├─ css
│  │  └─ style.css
│  ├─ favicon.ico
│  ├─ index.php
│  └─ robots.txt
├─ README.md
├─ resources
│  ├─ css
│  │  └─ app.css
│  ├─ js
│  │  ├─ app.js
│  │  └─ bootstrap.js
│  └─ views
│     ├─ admin
│     │  ├─ dashboard.blade.php
│     │  ├─ health-records.blade.php
│     │  ├─ sleep-records.blade.php
│     │  └─ users.blade.php
│     ├─ auth
│     │  ├─ admin
│     │  │  ├─ login.blade.php
│     │  │  └─ register.blade.php
│     │  ├─ login.blade.php
│     │  ├─ logout.blade.php
│     │  ├─ register.blade.php
│     │  └─ superadmin
│     │     └─ register.blade.php
│     ├─ dashboard.blade.php
│     ├─ layouts
│     │  ├─ admin.blade.php
│     │  ├─ app.blade.php
│     │  └─ superadmin.blade.php
│     ├─ profile.blade.php
│     ├─ rekam_medis.blade.php
│     ├─ sleep
│     │  └─ sleep_index.blade.php
│     └─ superadmin
│        ├─ admins.blade.php
│        ├─ dashboard.blade.php
│        ├─ health-records.blade.php
│        ├─ sleep-records.blade.php
│        ├─ statistics.blade.php
│        └─ users.blade.php
├─ routes
│  ├─ console.php
│  └─ web.php
├─ storage
│  ├─ app
│  │  ├─ private
│  │  └─ public
│  ├─ framework
│  │  ├─ cache
│  │  │  └─ data
│  │  ├─ sessions
│  │  │  ├─ IEyxUkmPNKRu6wM5yguFj15ZfcQNYYp1h6ey4YJf
│  │  │  └─ WGvWk5PcnBQRpgrglf30zZtYJq1gMv1uQvE5qGx3
│  │  ├─ testing
│  │  └─ views
│  │     ├─ 08d77c0455a4ccb63c12fd993e9d2599.php
│  │     ├─ 090cbe3e3ee85319baf67ef48d7aca0d.php
│  │     ├─ 0ac2a1ba9db6ae4ca1abad2cd4663ecb.php
│  │     ├─ 0eca700e20c25687eb735e3e81253b11.php
│  │     ├─ 10ee136610af01c43a57fe6e7a740e5f.php
│  │     ├─ 15fa2b9bd48efc3c8fa88a7173ee4e6e.php
│  │     ├─ 1fe2810928ecf743f1a9a8dc47661c92.php
│  │     ├─ 30eeb3c5289bfd098a9a2493a4b02b2a.php
│  │     ├─ 31fb89b059615e41a0cdd757f1a7e64d.php
│  │     ├─ 32bcedf49c3df634db8e1c0a881f7a46.php
│  │     ├─ 3407a134b3fba80f745c08204dd68655.php
│  │     ├─ 40b4263a2039557f3aa076002dd5ac23.php
│  │     ├─ 480635c6a4fa92d50e62f1856bb52fc6.php
│  │     ├─ 5217bb72df45543fe7d963712ad34aeb.php
│  │     ├─ 547fcbc794fee698009b8f5f7fd1b2f2.php
│  │     ├─ 5506858f92aeed426c4049cada3fec18.php
│  │     ├─ 576ffded34d3e96c8a91838c141b3524.php
│  │     ├─ 58c57eaeeac25fe003ec70fdc3198c8e.php
│  │     ├─ 5fbce35448cf93a51699450ffe2c58cb.php
│  │     ├─ 61df6943ad04f6213eda97d42b18c110.php
│  │     ├─ 6594800ff4b9a59b2a2aad34bbcd1a0f.php
│  │     ├─ 659b110c75508d49a89d1656fd895fd8.php
│  │     ├─ 66c01b42486efed1dba99b8385f572ee.php
│  │     ├─ 68f7c07ae9046434d52cf52a2625d618.php
│  │     ├─ 6a7e45441c4ff8383484ad3f263669b6.php
│  │     ├─ 6f27fdd253d209ddb16b76b0ad0f14e0.php
│  │     ├─ 7698316b8ebd9e01d3444c7ba4e9ddc0.php
│  │     ├─ 7c57629a96c4875f3bf3b6c7f53a2f08.php
│  │     ├─ 7ca88eae2cc5e0219c0c42d1c4a80fb7.php
│  │     ├─ 7cd7563c22e6b84c514e3d68a0606994.php
│  │     ├─ 8d527fe0b0e8e4abd74ce563b8031711.php
│  │     ├─ 8f92e3b08d7b61a1b90c2963f5cf78ef.php
│  │     ├─ 9377d973f01dede0bbd7ea60e8d752eb.php
│  │     ├─ 9ab9f75926bc4aa0e77f249f118d3d2b.php
│  │     ├─ a0d7d3190be0f5477a5053d3f58e425d.php
│  │     ├─ a72d8eb1e1e296d9850f3a36a85455f2.php
│  │     ├─ ab54a96e9b91bc23a03abd85c240c170.php
│  │     ├─ ab7bf710340f97a4887bc9e639944b06.php
│  │     ├─ ace3ebe80990600622d5bc9d033758bb.php
│  │     ├─ b3e70e492635c82c3e38dc207f2829fd.php
│  │     ├─ b7720e1b610ca0004b4c5359bda9d2d7.php
│  │     ├─ ba3b09916d79a72bd1c7bc91ed40f007.php
│  │     ├─ bd1005427285096f53911e9ab3d0ae1c.php
│  │     ├─ c747c701f86ca1f664749a0fe0f660a3.php
│  │     ├─ ca159d5ebd3322c141d88fd1f6e774bc.php
│  │     ├─ ca7c9464ac896a424f0e3419521f619d.php
│  │     ├─ d174abce3547b83ea87750611afc41e3.php
│  │     ├─ d358a6c9e77c950dc223a2de32ba72bc.php
│  │     ├─ d6723a001807f0943b19bcf7834cc4d8.php
│  │     ├─ d96dd0a00393ff0c49979ab9ad4dc19b.php
│  │     ├─ dbddd2e364e4fceb5e2b6c7cad49d11c.php
│  │     ├─ de89432ed18fa4d1f3d90346863583f0.php
│  │     ├─ e245215233948290420b25ce4b877674.php
│  │     ├─ e54b6314db4fa34a3dcc88b42ac574fe.php
│  │     ├─ e5f62f0a1a2b81b6bc84285105df54f7.php
│  │     ├─ ea1236b54d94aac7d48e3bf47ccf0e3f.php
│  │     ├─ eacd2c1384649eb724ac399e0dc533e1.php
│  │     ├─ ecd1cffad591e88937cf2480c01f0875.php
│  │     ├─ ed542e2d4cff47e25d90778d0df6a6f2.php
│  │     ├─ eddfcf0fd1f660ecd5d6396875413ced.php
│  │     ├─ f011646717e6a978053d005fdc297e1b.php
│  │     ├─ f6e739ce6f3be5acf2765cc009196372.php
│  │     └─ fcd1990609982217d9614f9f4aa5f353.php
│  └─ logs
├─ tests
│  ├─ Feature
│  │  └─ ExampleTest.php
│  ├─ TestCase.php
│  └─ Unit
│     └─ ExampleTest.php
└─ vite.config.js

```
```
eHealthCampus
├─ .editorconfig
├─ app
│  ├─ Http
│  │  ├─ Controllers
│  │  │  ├─ AdminController.php
│  │  │  ├─ AuthController.php
│  │  │  ├─ Controller.php
│  │  │  ├─ DashboardController.php
│  │  │  ├─ HealthRecordController.php
│  │  │  ├─ LoginController.php
│  │  │  ├─ MedicalRecordController.php
│  │  │  ├─ ProfileController.php
│  │  │  ├─ SleepController.php
│  │  │  └─ SuperAdminController.php
│  │  └─ Middleware
│  │     └─ RoleMiddleware.php
│  ├─ Models
│  │  ├─ HealthRecord.php
│  │  ├─ SleepRecord.php
│  │  └─ User.php
│  └─ Providers
│     └─ AppServiceProvider.php
├─ artisan
├─ bootstrap
│  ├─ app.php
│  ├─ cache
│  │  ├─ packages.php
│  │  └─ services.php
│  └─ providers.php
├─ composer.json
├─ composer.lock
├─ config
│  ├─ app.php
│  ├─ auth.php
│  ├─ cache.php
│  ├─ database.php
│  ├─ filesystems.php
│  ├─ logging.php
│  ├─ mail.php
│  ├─ queue.php
│  ├─ services.php
│  └─ session.php
├─ database
│  ├─ database.sqlite
│  ├─ factories
│  │  └─ UserFactory.php
│  ├─ migrations
│  │  ├─ 0001_01_01_000000_create_users_table.php
│  │  ├─ 2026_04_05_080148_create_health_records_table.php
│  │  ├─ 2026_04_16_202631_add_columns_to_health_records_table.php
│  │  ├─ 2026_04_16_203051_remove_record_date_from_health_records_table.php
│  │  ├─ 2026_04_16_203626_fix_status_column_in_health_records.php
│  │  ├─ 2026_04_18_064425_create_sleep_records_table.php
│  │  ├─ 2026_04_18_070717_add_date_to_sleep_records_table.php
│  │  ├─ 2026_04_27_103059_add_role_to_users_table.php
│  │  └─ 2026_04_27_fix_nullable_tb_bb.php
│  └─ seeders
│     └─ DatabaseSeeder.php
├─ ehealth_db
├─ package.json
├─ phpunit.xml
├─ public
│  ├─ .htaccess
│  ├─ css
│  │  └─ style.css
│  ├─ favicon.ico
│  ├─ index.php
│  └─ robots.txt
├─ README.md
├─ resources
│  ├─ css
│  │  └─ app.css
│  ├─ js
│  │  ├─ app.js
│  │  └─ bootstrap.js
│  └─ views
│     ├─ admin
│     │  ├─ dashboard.blade.php
│     │  ├─ health-records.blade.php
│     │  ├─ sleep-records.blade.php
│     │  └─ users.blade.php
│     ├─ auth
│     │  ├─ admin
│     │  │  ├─ login.blade.php
│     │  │  └─ register.blade.php
│     │  ├─ login.blade.php
│     │  ├─ logout.blade.php
│     │  ├─ register.blade.php
│     │  └─ superadmin
│     │     └─ register.blade.php
│     ├─ dashboard.blade.php
│     ├─ layouts
│     │  ├─ admin.blade.php
│     │  ├─ app.blade.php
│     │  └─ superadmin.blade.php
│     ├─ profile.blade.php
│     ├─ rekam_medis.blade.php
│     ├─ sleep
│     │  └─ sleep_index.blade.php
│     └─ superadmin
│        ├─ admins.blade.php
│        ├─ dashboard.blade.php
│        ├─ health-records.blade.php
│        ├─ sleep-records.blade.php
│        ├─ statistics.blade.php
│        └─ users.blade.php
├─ routes
│  ├─ console.php
│  └─ web.php
├─ storage
│  ├─ app
│  │  ├─ private
│  │  └─ public
│  ├─ framework
│  │  ├─ cache
│  │  │  └─ data
│  │  ├─ sessions
│  │  │  ├─ IEyxUkmPNKRu6wM5yguFj15ZfcQNYYp1h6ey4YJf
│  │  │  └─ WGvWk5PcnBQRpgrglf30zZtYJq1gMv1uQvE5qGx3
│  │  ├─ testing
│  │  └─ views
│  │     ├─ 08d77c0455a4ccb63c12fd993e9d2599.php
│  │     ├─ 090cbe3e3ee85319baf67ef48d7aca0d.php
│  │     ├─ 0ac2a1ba9db6ae4ca1abad2cd4663ecb.php
│  │     ├─ 0eca700e20c25687eb735e3e81253b11.php
│  │     ├─ 10ee136610af01c43a57fe6e7a740e5f.php
│  │     ├─ 15fa2b9bd48efc3c8fa88a7173ee4e6e.php
│  │     ├─ 1fe2810928ecf743f1a9a8dc47661c92.php
│  │     ├─ 30eeb3c5289bfd098a9a2493a4b02b2a.php
│  │     ├─ 31fb89b059615e41a0cdd757f1a7e64d.php
│  │     ├─ 32bcedf49c3df634db8e1c0a881f7a46.php
│  │     ├─ 3407a134b3fba80f745c08204dd68655.php
│  │     ├─ 40b4263a2039557f3aa076002dd5ac23.php
│  │     ├─ 480635c6a4fa92d50e62f1856bb52fc6.php
│  │     ├─ 5217bb72df45543fe7d963712ad34aeb.php
│  │     ├─ 547fcbc794fee698009b8f5f7fd1b2f2.php
│  │     ├─ 5506858f92aeed426c4049cada3fec18.php
│  │     ├─ 576ffded34d3e96c8a91838c141b3524.php
│  │     ├─ 58c57eaeeac25fe003ec70fdc3198c8e.php
│  │     ├─ 5fbce35448cf93a51699450ffe2c58cb.php
│  │     ├─ 61df6943ad04f6213eda97d42b18c110.php
│  │     ├─ 6594800ff4b9a59b2a2aad34bbcd1a0f.php
│  │     ├─ 659b110c75508d49a89d1656fd895fd8.php
│  │     ├─ 66c01b42486efed1dba99b8385f572ee.php
│  │     ├─ 68f7c07ae9046434d52cf52a2625d618.php
│  │     ├─ 6a7e45441c4ff8383484ad3f263669b6.php
│  │     ├─ 6f27fdd253d209ddb16b76b0ad0f14e0.php
│  │     ├─ 7698316b8ebd9e01d3444c7ba4e9ddc0.php
│  │     ├─ 7c57629a96c4875f3bf3b6c7f53a2f08.php
│  │     ├─ 7ca88eae2cc5e0219c0c42d1c4a80fb7.php
│  │     ├─ 7cd7563c22e6b84c514e3d68a0606994.php
│  │     ├─ 8d527fe0b0e8e4abd74ce563b8031711.php
│  │     ├─ 8f92e3b08d7b61a1b90c2963f5cf78ef.php
│  │     ├─ 9377d973f01dede0bbd7ea60e8d752eb.php
│  │     ├─ 9ab9f75926bc4aa0e77f249f118d3d2b.php
│  │     ├─ a0d7d3190be0f5477a5053d3f58e425d.php
│  │     ├─ a72d8eb1e1e296d9850f3a36a85455f2.php
│  │     ├─ ab54a96e9b91bc23a03abd85c240c170.php
│  │     ├─ ab7bf710340f97a4887bc9e639944b06.php
│  │     ├─ ace3ebe80990600622d5bc9d033758bb.php
│  │     ├─ b3e70e492635c82c3e38dc207f2829fd.php
│  │     ├─ b7720e1b610ca0004b4c5359bda9d2d7.php
│  │     ├─ ba3b09916d79a72bd1c7bc91ed40f007.php
│  │     ├─ bd1005427285096f53911e9ab3d0ae1c.php
│  │     ├─ c747c701f86ca1f664749a0fe0f660a3.php
│  │     ├─ ca159d5ebd3322c141d88fd1f6e774bc.php
│  │     ├─ ca7c9464ac896a424f0e3419521f619d.php
│  │     ├─ d174abce3547b83ea87750611afc41e3.php
│  │     ├─ d358a6c9e77c950dc223a2de32ba72bc.php
│  │     ├─ d6723a001807f0943b19bcf7834cc4d8.php
│  │     ├─ d96dd0a00393ff0c49979ab9ad4dc19b.php
│  │     ├─ dbddd2e364e4fceb5e2b6c7cad49d11c.php
│  │     ├─ de89432ed18fa4d1f3d90346863583f0.php
│  │     ├─ e245215233948290420b25ce4b877674.php
│  │     ├─ e54b6314db4fa34a3dcc88b42ac574fe.php
│  │     ├─ e5f62f0a1a2b81b6bc84285105df54f7.php
│  │     ├─ ea1236b54d94aac7d48e3bf47ccf0e3f.php
│  │     ├─ eacd2c1384649eb724ac399e0dc533e1.php
│  │     ├─ ecd1cffad591e88937cf2480c01f0875.php
│  │     ├─ ed542e2d4cff47e25d90778d0df6a6f2.php
│  │     ├─ eddfcf0fd1f660ecd5d6396875413ced.php
│  │     ├─ f011646717e6a978053d005fdc297e1b.php
│  │     ├─ f6e739ce6f3be5acf2765cc009196372.php
│  │     └─ fcd1990609982217d9614f9f4aa5f353.php
│  └─ logs
├─ tests
│  ├─ Feature
│  │  └─ ExampleTest.php
│  ├─ TestCase.php
│  └─ Unit
│     └─ ExampleTest.php
└─ vite.config.js

```