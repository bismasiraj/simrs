USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D16_Grafik_Dokter]    Script Date: 13/03/2018 17:34:49 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D16_Grafik_Dokter]
AS  
BEGIN  

  select  pv.EMPLOYEE_ID, ea.fullname, count(no_registration) as jml
from PASIEN_VISITATION pv , EMPLOYEE_ALL ea, CLINIC c
where pv.EMPLOYEE_ID is not null and pv.EMPLOYEE_ID <> ' ' and pv.clinic_id is not null
and convert(varchar(10),visit_date,121) = convert(varchar(10),GETDATE(),121)
and pv.EMPLOYEE_ID = ea.EMPLOYEE_ID
and c.CLINIC_ID = pv.CLINIC_ID
and c.STYPE_ID in (1)
--and CLINIC.CLINIC_ID in (select clinic_id from clinic where STYPE_ID = 1)
group by pv.EMPLOYEE_ID , ea.FULLNAME
order by jml desc





END  
GO

