create table goods(
	id int primary key auto_increment,
	goods_name varchar(32) not null,
	shop_price decimal(9,2) not null,
	cat_id int
)engine myisam charset utf8;
insert into goods values(null,'油条',12.34,1);
insert into goods values(null,'包子',22.34,1);
insert into goods values(null,'煎饼',12.74,1);
insert into goods values(null,'甜末',18.34,1);
insert into goods values(null,'肠粉',52.34,1);

insert into goods values(null,'键盘',10.34,2);
insert into goods values(null,'鼠标',29.34,2);
insert into goods values(null,'耳机',72.74,2);
insert into goods values(null,'光驱',68.34,2);
insert into goods values(null,'音响',50.34,2);

insert into goods values(null,'杯子',12.34,3);
insert into goods values(null,'汤勺',12.34,3);
insert into goods values(null,'水壶',12.74,3);
insert into goods values(null,'罐子',58.34,3);
insert into goods values(null,'盒子',52.34,3);

insert into goods values(null,'芹菜',70.34,4);
insert into goods values(null,'萝卜',29.44,4);
insert into goods values(null,'海菜',82.74,4);
insert into goods values(null,'白菜',48.74,4);
insert into goods values(null,'大葱',20.34,4);

insert into goods values(null,'苹果',10.34,5);
insert into goods values(null,'桃子',89.44,5);
insert into goods values(null,'山楂',82.74,5);
insert into goods values(null,'桔子',48.74,5);
insert into goods values(null,'狼桃',60.34,5);
insert into goods values(null,'芒果',10.34,5);
create table category(
	id int primary key auto_increment,
	cat_name varchar(32) not null
)engine myisam charset utf8;
insert into category values(null,'小吃');
insert into category values(null,'配件');
insert into category values(null,'家用');
insert into category values(null,'蔬菜');
insert into category values(null,'水果');




create procedure p2(num int )
begin
	case num
	when 1 then select '春天' as '季节';
	when 2 then  select '夏天' as '季节';
	when 3 then  select '秋天' as '季节';
	when 4 then  select '冬天' as '季节';
	else  select '无法无天' as '季节';
	end case;
end$

create procedure p3(n int)
begin
	declare i int default 1;
	declare s int default 0;
	aa:loop
		set s=s+i;
		set i=i+1;
		if i>n then
		leave aa;
		end if;
	end loop;
	select s;
end