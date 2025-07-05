USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D17_Sensus_Ranap]    Script Date: 13/03/2018 17:34:56 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D17_Sensus_Ranap]
AS  
BEGIN  

SELECT
		c.name_of_clinic,

		isnull((select count(bill_id) from treatment_akomodasi ta where ta.treat_date >= dateadd(hour,0,convert(varchar(10),GETDATE(),121)) and  ta.treat_date < dateadd(hour,24,convert(varchar(10),GETDATE(),121)) and ta.clinic_id = c.clinic_id  AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE '%'  ),0)as masuk,
		isnull((select count(bill_id) from treatment_akomodasi ta where ta.exit_date >= dateadd(hour,0,convert(varchar(10),GETDATE(),121)) and ta.exit_date < dateadd(hour,24,convert(varchar(10),GETDATE(),121)) and keluar_id <> 0 and ta.clinic_id = c.clinic_id AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE '%'  and ta.keluar_id not in (0,3,4) ),0) as hidup,
		isnull((select count(bill_id) from treatment_akomodasi ta where ta.exit_date >= dateadd(hour,0,convert(varchar(10),GETDATE(),121)) and ta.exit_date < dateadd(hour,24,convert(varchar(10),GETDATE(),121)) and keluar_id <> 0 and ta.clinic_id = c.clinic_id AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE '%' and ta.keluar_id  in (3) ),0) as matik48,
		isnull((select count(bill_id) from treatment_akomodasi ta where ta.exit_date >= dateadd(hour,0,convert(varchar(10),GETDATE(),121)) and ta.exit_date < dateadd(hour,24,convert(varchar(10),GETDATE(),121)) and keluar_id <> 0 and ta.clinic_id = c.clinic_id AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE '%'  and ta.keluar_id  in (4) ),0) as matil48,
		isnull((select count(bill_id) from treatment_akomodasi ta where ta.treat_date < convert(varchar(10),GETDATE(),121) and (ta.keluar_id = 0 or ta.exit_date >= convert(varchar(10),GETDATE(),121)) and ta.clinic_id = c.clinic_id AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE '%'  ),0) as awal ,
        isnull((select sum(datediff(day,ta.treat_date, ta.exit_date)) from treatment_akomodasi ta where ta.exit_date >= dateadd(hour,0,convert(varchar(10),GETDATE(),121)) and ta.exit_date < dateadd(hour,24,convert(varchar(10),GETDATE(),121)) and ta.keluar_id <> 0 and ta.keluar_id is not null and ta.clinic_id = c.clinic_id AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE '%' ),0)as lama,
		isnull((select sum( 1 + datediff(day, case  when ta.treat_date <  dateadd(hour,0,convert(varchar(10),GETDATE(),121)) then convert(varchar(10),GETDATE(),121)
													when  ta.treat_date >=  dateadd(hour,0,convert(varchar(10),GETDATE(),121)) then ta.treat_date   end,
											  case	when ta.exit_date >= dateadd(hour,24,convert(varchar(10),GETDATE(),121)) then convert(varchar(10),GETDATE(),121)
													when ta.exit_date < dateadd(hour,24,convert(varchar(10),GETDATE(),121)) and ta.exit_date >= dateadd(hour,0,convert(varchar(10),GETDATE(),121)) then ta.exit_date
													when ta.exit_date is null then convert(varchar(10),GETDATE(),121)
													when ta.exit_date < convert(varchar(10),GETDATE(),121) then convert(varchar(10),GETDATE(),121)
													when ta.exit_date is  null and ta.keluar_id = 0 then convert(varchar(10),GETDATE(),121)
												end ) )
			from treatment_akomodasi ta where ta.treat_date is not null and ((ta.treat_date >= dateadd(hour,0,convert(varchar(10),GETDATE(),121)) and ta.treat_date < dateadd(hour,24,convert(varchar(10),GETDATE(),121)))
					or(ta.treat_date >= dateadd(hour,0,convert(varchar(10),GETDATE(),121)) and ta.treat_date < dateadd(hour,24,convert(varchar(10),GETDATE(),121)) ) or( ta.exit_date >=dateadd(hour,0,convert(varchar(10),GETDATE(),121)) and ta.treat_date < dateadd(hour,24,convert(varchar(10),GETDATE(),121)))
					or (ta.treat_date <= dateadd(hour,0,convert(varchar(10),GETDATE(),121)) and keluar_id = 0 ) or (ta.treat_date < dateadd(hour,0,convert(varchar(10),GETDATE(),121)) and ta.exit_date > = dateadd(hour,0,convert(varchar(10),GETDATE(),121))) )
					and  ta.clinic_id = c.clinic_id   AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE '%' ),0)	as hari,
      380 as beds,
		FA_V AS TT,
isnull((select count(bill_id) from treatment_akomodasi ta where ta.exit_date >= dateadd(hour,0,convert(varchar(10),GETDATE(),121)) and ta.exit_date < dateadd(hour,24,convert(varchar(10),GETDATE(),121)) and keluar_id <> 0 and ta.clinic_id = c.clinic_id AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE '%'  and datediff(day,ta.treat_date,ta.exit_date) = 0 ),0) as harisama


FROM  clinic  c
WHERE c.stype_id = 3

GROUP BY
       c.name_of_clinic, c.clinic_id,FA_V

order by c.clinic_id






END  
GO

