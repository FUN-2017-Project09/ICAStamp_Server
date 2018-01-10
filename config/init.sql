create database dotinstall_sns_php;

grant all on dotinstall_sns_php.* to dbuser@localhost identified by 'mu4uJsif';

use dotinstall_sns_php

--
#
/*から*/

create table users (
  id int not null auto_increment primary key, -- 自動連番
  email varchar(255) unique, -- email用 ユニークキー
  password varchar(255), -- パスワード
  created datetime, -- 作成日時
  modified datetime -- 変更日時
);

desc users;