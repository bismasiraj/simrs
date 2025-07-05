USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D12_Pasien_Perdaerah]    Script Date: 13/03/2018 17:34:24 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D12_Pasien_Perdaerah]
AS  
BEGIN  


 SELECT count((no_registration))  as jml,
   Nama_kota as isnew
    FROM PASIEN,kota
where no_registration in (select no_registration from pasien_visitation where
year(visit_date)  =  year(getdate() ) and
month(visit_date)  =  month(getdate()) and
day(visit_date)  =  day(getdate())    )
 and
( isnull( left(KAL_ID,4),1000) = KODE_KOTA or isnull( left(pasien.KAL_ID,5),1000) = left(KODE_KOTA,5) )
group by  nama_kota



END  
GO

