<p align="center">
<img src="https://viv.changewindows.org/img/logo.png" width="100px" height="auto">
</p>

<h3 align="center">ChangeWindows viv</h3>

<p align="center">
Changing viv one commit at a time
<br />
<br />
<a href="https://viv.changewindows.org">ChangeWindows viv</a>
&middot;
<a href="https://changewindows.org">ChangeWindows</a>
</p>

## About ChangeWindows
ChangeWindows does what Microsoft doesn't: document every change we can possibly find in Windows on any platform.

## Open source
This repository is a big shift for ChangeWindows from the previous 4 major versions. Not only is this the first time we're publishing the actual source of our website, we're also using for the first time a framework, in this case Laravel, to build our website. Not only because we're lazy, but also because it makes things a lot simpeler and cleaner.

## Using
To run ChangeWindows, you'll need the following:

* PHP 7.2.0 or higher, including extensions required by Laravel 6.x
* MySQL
* Composer
* NPM

### Setup
Clone this repository to any given directory and setup the `.env` file with all required parameters. An example of an `.env` file can be found in `.env.example`. Then execute the following commands.

```
composer install
npm install
php artisan migrate
php artisan db:seed
```

To run ChangeWindows, use the following command:

```
php artisan serve
```

This will launch a server at `127.0.0.1:8000`. Also run this NPM command.

```
npm run watch
```

This will compile various files, mostly SCSS and keep an eye out for changes.

For a production build, execute the following commands:

```
composer install --prefer-dist --no-scripts --no-dev -o
npm install --production
```

### Login details
After migrating and seeding the database, there will be 3 accounts from the start.

| Name | Email | Role | Password |
| ---- | ----- | ---- | -------- |
| Yannick | yannick@changewindows.org | Admin | secret |
| Viv | viv@changewindows.org | Insider | secret |
| Tom | tom@changewindows.org | User | secret |

## Contributing
We are open to contributions to ChangeWindows. Do you have a feature that you really want to see but we are not spending any time on it ourselves? Feel free to open a pull request for it!

## Security Vulnerabilities
If you discover a security vulnerability within ChangeWindows, please contact us through private means. Most successful would probably be to contact us on [Twitter](https://twitter.com/changewindows).

## License
The ChangeWindows website is open-sourced software licensed under the [AGPL license](LICENSE). Note however that the content on our website isn't unless stated otherwise.

## Version 6.0 migration
### Alpha 1
```sql
alter table `roles` add `is_default` int not null default '0' after `description`;
alter table `users` add `onboarding` varchar(191) null after `email`, add `role_id` bigint unsigned not null;
alter table `users` add constraint `users_role_id_foreign` foreign key (`role_id`) references `roles` (`id`);
create table `abilities` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(191) not null, `label` varchar(191) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
create table `ability_role` (`role_id` bigint unsigned not null, `ability_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `ability_role` add primary key `ability_role_role_id_ability_id_primary`(`role_id`, `ability_id`);
alter table `ability_role` add constraint `ability_role_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete cascade;
alter table `ability_role` add constraint `ability_role_ability_id_foreign` foreign key (`ability_id`) references `abilities` (`id`) on delete cascade;
alter table `users` add `avatar` varchar(191) null after `email`;
```

### Alpha 2
```sql
alter table `milestones` add `start_build` int unsigned null after `color`;

create table `platforms` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(191) not null, `color` varchar(191) not null, `icon` varchar(191) not null, `active` int not null default '1', `slug` varchar(191) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `platforms` add unique `platforms_slug_unique`(`slug`);
create table `milestone_platforms` (`id` bigint unsigned not null auto_increment primary key, `platform_id` bigint unsigned not null, `milestone_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `milestone_platforms` add constraint `milestone_platforms_platform_id_foreign` foreign key (`platform_id`) references `platforms` (`id`);
alter table `milestone_platforms` add constraint `milestone_platforms_milestone_id_foreign` foreign key (`milestone_id`) references `milestones` (`id`);

create table `channels` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(191) not null, `color` varchar(191) not null, `position` int not null, `slug` varchar(191) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `channels` add unique `channels_slug_unique`(`slug`);
create table `channel_platforms` (`id` bigint unsigned not null auto_increment primary key, `platform_id` bigint unsigned not null, `channel_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `channel_platforms` add constraint `channel_platforms_platform_id_foreign` foreign key (`platform_id`) references `platforms` (`id`);
alter table `channel_platforms` add constraint `channel_platforms_channel_id_foreign` foreign key (`channel_id`) references `channels` (`id`);
```