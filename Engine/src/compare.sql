create or replace function compare(sql1 character varying, sql2 character varying) returns boolean
as $body$
Declare lCount int := 0;
Begin

 EXECUTE 'SELECT COUNT(Res.*) FROM (  ((' || sql1 || ')  EXCEPT (' || sql2  || ')) UNION ((' || sql2 || ')  EXCEPT  (' || sql1 || ')) ) Res' INTO lCount;

IF (lCount = 0) then
    RETURN TRUE;
 ELSE
    RETURN FALSE;
 END IF;

 End;
$body$ language 'plpgsql';