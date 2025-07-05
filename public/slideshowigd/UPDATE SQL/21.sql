USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D19_Ranap_Status]    Script Date: 13/03/2018 17:35:10 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D19_Ranap_Status]
AS  
BEGIN  

SELECT COUNT(no_registration) AS terisi, sp.NAME_OF_STATUS_PASIEN as status_bayar FROM treatment_akomodasi pv inner join STATUS_PASIEN sp
on pv.STATUS_PASIEN_ID = sp.STATUS_PASIEN_ID
 RIGHT join CLASS_ROOM on
         pv.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID AND
         pv.class_room_id is not null
		 and (pv.keluar_id = 0 or pv.keluar_id=33) RIGHT join CLINIC C ON
		 CLASS_ROOM.CLINIC_ID = C.CLINIC_ID
WHERE
		 C.STYPE_ID IN (3) and sp.NAME_OF_STATUS_PASIEN is not null
group by sp.NAME_OF_STATUS_PASIEN
order by terisi






END  
GO

