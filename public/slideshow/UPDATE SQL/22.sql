USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D20_Grafik_Poliklinik]    Script Date: 13/03/2018 17:35:15 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D20_Grafik_Poliklinik]
AS  
BEGIN  
	   select
	count(case when ISNULL(pv.ISATTENDED,1) = 1 and ISNULL(pv.ISNEW,0) = 1 then pv.VISIT_ID end) as bterlayani,
	count(case when ISNULL(pv.ISATTENDED,1) = 1 and ISNULL(pv.ISNEW,0) = 0 then pv.VISIT_ID end) as lterlayani,
	c.NAME_OF_CLINIC as poli
	from pasien_visitation pv, clinic c
	where pv.CLINIC_ID = c.CLINIC_ID
	and c.STYPE_ID in (1,2,5)
	and pv.VISIT_DATE between DATEADD(hour,0,convert(varchar(10),GETDATE(),121)) and DATEADD(hour,23,convert(varchar(10),GETDATE(),121))
	group by c.NAME_OF_CLINIC
	order by c.NAME_OF_CLINIC
END  
GO

