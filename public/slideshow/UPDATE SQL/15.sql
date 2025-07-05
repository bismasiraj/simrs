USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D13_Pasien_Perumur]    Script Date: 13/03/2018 17:34:30 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D13_Pasien_Perumur]
AS  
BEGIN  


SELECT count(no_registration)  as jml,
display as isnew,
age_range
    FROM PASIEN,age_range
where no_registration in (select no_registration from pasien_visitation where
year(visit_date)  =  year(getdate() ) and
month(visit_date)  =  month(getdate()) and
day(visit_date)  =  day(getdate())   )
and
datediff(day,date_of_birth,getdate() ) >= LOWER_BOUND and
datediff(day,date_of_birth,getdate() )  <= UPPER_BOUND
group by AGE_RANGE,display
order by AGE_RANGE



END  
GO

