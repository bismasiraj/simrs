USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D05_Pemeriksaan_Radiologi]    Script Date: 13/03/2018 17:33:32 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D05_Pemeriksaan_Radiologi]
AS  
BEGIN  
select top(10) count(bill_id) as jml,
			tb.tarif_id,
			tt.tarif_name
		from treatment_bill tb,treat_tarif tt
 where  tb.tarif_id = tt.tarif_id and
year(TREAT_DATE) = year(getdate()) and month(TREAT_DATE) = month(getdate()) and day(TREAT_DATE) = day(getdate())
and left(tt.treat_id,2) = '08'
group by tb.tarif_id,tt.tarif_name
order by jml desc
END  
GO

