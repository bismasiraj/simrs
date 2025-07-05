USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D18_Rajal_Perstatus]    Script Date: 13/03/2018 17:35:03 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D18_Rajal_Perstatus]
AS  
BEGIN  

  SELECT count( PASIEN_VISITATION.VISIT_ID)  as jml,
         PASIEN_VISITATION.STATUS_PASIEN_ID  ,
c.NAME_OF_STATUS_PASIEN
    FROM PASIEN_VISITATION  ,status_pasien c
where
c.status_pasien_id = pasien_visitation.STATUS_PASIEN_ID and
year(visit_date)  =  year(getdate() ) and
month(visit_date)  =  month(getdate()) and
day(visit_date)  =  day(getdate()) and
 pasien_visitation.clinic_id in (select clinic_id from clinic where stype_id in (1,2,5) )


group by  PASIEN_VISITATION.STATUS_PASIEN_ID ,NAME_OF_STATUS_PASIEN






END  
GO

