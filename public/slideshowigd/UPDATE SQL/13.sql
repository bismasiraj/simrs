USE [RSUD_bengkulu]
GO

/****** Object:  StoredProcedure [dbo].[web_D11_Ketersediaan_TT_Perkelas]    Script Date: 13/03/2018 17:34:18 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[web_D11_Ketersediaan_TT_Perkelas]
AS  
BEGIN  


SELECT  clinic.name_of_clinic,
		CLASS_ROOM.NAME_OF_CLASS,

         (SELECT COUNT(BED_ID) FROM BEDS WHERE
         CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID AND ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE) AS cap,

        (SELECT COUNT(no_registration) FROM treatment_akomodasi pv WHERE
         pv.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID and
         pv.class_room_id is not null
         and (pv.keluar_id = 0 or pv.keluar_id=33) AND  pv.ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE) AS ISI,
         (SELECT SUM(TC.AMOUNT) FROM TARIF_COMP TC, TREAT_TARIF TT
         WHERE TC.TARIF_ID = CLASS_ROOM.TARIF_ID AND TC.TARIF_ID = TT.TARIF_ID) as TARIF,
		 CLASS_ROOM.CLASS_ID
FROM CLASS_ROOM, clinic
where CLASS_ROOM.org_unit_code= '1771014'
      and CLASS_ROOM.clinic_id=clinic.clinic_id
      and CLASS_ROOM.isactive = '1'
ORDER BY CLASS_ROOM.CLASS_ID,clinic.name_of_clinic

END  
GO

