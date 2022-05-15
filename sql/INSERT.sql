insert into belongs values(01,'営業');
insert into belongs values(02,'総務');
insert into belongs values(03,'人事');
insert into divisions values(01,01,'営業一課');
insert into divisions values(01,02,'営業二課');
insert into divisions values(02,05,'経理課');
insert into divisions values(02,06,'厚生課');
insert into divisions values(03,11,'人事課');
insert into divisions values(03,12,'教育課');

insert into employee(id,name,bg_id,d_id)value(16010228,'小林晃年',01,01),
(15010226,'石原梨花',01,02),(13020305,'平塚俊雄',02,05),(17021112,'関口隆',02,06),
(20030702,'古橋紗奈',03,11),(21031201,'遠藤浩二',03,12),(18030704,'戸塚和美',03,11),
(19011118,'日野紗奈',01,02),(16020412,'藤森加奈',02,06),(15030815,'近藤武',03,12);

commit;