USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D21_Grafik_Rujukan]    Script Date: 13/03/2018 17:35:30 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D21_Grafik_Rujukan]
as
BEGIN  
select 
count(pv.VISIT_ID) as jml,
rj.NAME_OF_RUJUKAN

from PASIEN_VISITATION pv, RUJUKAN rj
where pv.RUJUKAN_ID = rj.RUJUKAN_ID and
year(visit_date)  =  year(getdate() ) and
month(visit_date)  =  month(getdate()) and
day(visit_date)  =  day(getdate())    
group by rj.NAME_OF_RUJUKAN
order by rj.NAME_OF_RUJUKAN
END  
GO

