USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D09_Diagnosa_Ranap]    Script Date: 13/03/2018 17:34:08 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D09_Diagnosa_Ranap]
AS  
BEGIN  
   SELECT top (10) count( pd.PASIEN_DIAGNOSA_ID)  as jml,
         pd.DIAGNOSA_ID ,
d.name_of_diagnosa ,
case when month(getdate()) = 1 then 'Januari'
when month(getdate()) = 2 then  'Febuari'
when month(getdate()) = 3 then  'Maret'
when month(getdate()) = 4 then   'April'
when month(getdate()) = 5 then  'Mei'
when month(getdate()) = 6 then  'Juni'
when month(getdate()) = 7 then  'Juli'
when month(getdate()) = 8 then  'Agustus'
when month(getdate()) = 9 then  'September'
when month(getdate()) = 10 then 'Oktober'
when month(getdate()) = 11 then 'November'
when month(getdate()) = 12 then  'Desember'
end as bulan,
year(getdate()) as tahun
    FROM PASIEN_diagnosa pd  ,diagnosa d
where
pd.diagnosa_id = d.DIAGNOSA_ID and
CONVERT(varchar(10),pd.date_of_diagnosa,121) = CONVERT(varchar(10),getdate(),121)
--year(pd.DATE_OF_DIAGNOSA)  =  year(getdate() ) and
--month(pd.DATE_OF_DIAGNOSA)  =  month(getdate())
and pd.clinic_id in (select clinic_id from clinic where stype_id in (3))

group by  pd.diagnosa_id, d.NAME_OF_DIAGNOSA
order by  count( pd.PASIEN_DIAGNOSA_ID)   desc


END  
GO

