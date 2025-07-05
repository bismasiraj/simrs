USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D08_Diagnosa_Rajal]    Script Date: 13/03/2018 17:33:58 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D08_Diagnosa_Rajal]
AS  
BEGIN  
   SELECT top (10) count( pd.PASIEN_DIAGNOSA_ID)  as jml,
         pd.DIAGNOSA_ID ,
d.name_of_diagnosa ,
year(getdate()) as tahun
    FROM PASIEN_diagnosa pd  ,diagnosa d
where
pd.diagnosa_id = d.DIAGNOSA_ID and
CONVERT(varchar(10),pd.date_of_diagnosa,121) = CONVERT(varchar(10),getdate(),121)
--year(pd.DATE_OF_DIAGNOSA)  =  year(getdate() ) and
--month(pd.DATE_OF_DIAGNOSA)  =  month(getdate())
and pd.clinic_id in (select clinic_id from clinic where stype_id in (1))

group by  pd.diagnosa_id, d.NAME_OF_DIAGNOSA
order by  count( pd.PASIEN_DIAGNOSA_ID)   desc

END  
GO

