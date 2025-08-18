create table it_goods(
id int,
goods_name varchar(10),
goods_number int)charset utf8;
insert into it_goods values(1,'猪',22),(2,'羊',22),(3,'狗',22),(4,'猫',22);
create table it_order(
order_id int,
goods_id int,
much int)charset utf8;
)
insert into it_goods values(1,2,3);

create procedure p4(num smallint)
begin
declare i int;
declare n int;
set i=1;
set n=0;
while i<=num do
set n=n+i;
set i=i+1;
end while;
select n;
end$



create procedure p8(price float,str char(1))
begin
	if str='h' then
	select id,goods_name,shop_price from goods where shop_price>=price;
	else
	select id,goods_name,shop_price from goods  where shop_price<price;
	end if;
end$





create function sumhe(num1 int,num2 int) returns int
begin
	return num1+num2;
end$
select  id,title,from_unixtime(add_time,'%Y-%m-%d') from movie where   (from_unixtime(add_time,'%Y-%m-%d'))=date_sub(curdate(),interval 2 day);