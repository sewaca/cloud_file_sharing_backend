-- Выбрать всех работников какой-либо компании (например Yandex)
select * from meetings.employees where `organization_id` = (select id from meetings.organizations where `name`='Yandex')

-- 