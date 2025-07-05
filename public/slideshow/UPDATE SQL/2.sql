USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D01_2_PoliBulanan]    Script Date: 13/03/2018 17:32:42 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D01_2_PoliBulanan]
AS  
BEGIN  
select
count(distinct (case when ISNULL(PV.ISNEW,'0') = '1' THEN pv.NO_REGISTRATION END)) AS pasien_baru,
count(distinct(case when ISNULL(PV.ISNEW,'0') = '0' THEN pv.NO_REGISTRATION END)) AS pasien_lama,
MONTH(visit_date) as bulan,
YEAR(visit_date) as tahun
from PASIEN_VISITATION pv
where pv.VISIT_DATE between	DATEADD(month,-6,getdate()) and DATEADD(month,0,getdate())
group by MONTH(visit_date),YEAR(visit_date)
order by YEAR(visit_date) desc,MONTH(visit_date) desc

END  
GO

