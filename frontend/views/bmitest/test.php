<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">
      <form id="form1" name="form1" method="post" action="">
    <table width="31%" border="1">
      <tr>
        <td width="24%">เพศ :</td>
        <td width="76%" align="left"><input name="sex" type="radio" id="sex" value="M" checked />
          ชาย
		    <input type="radio" name="sex" id="sex" value="F" />หญิง</td>
      </tr>
      <tr>
        <td>น้ำหนัก</td>
        <td align="left"><input type="text" name="weight" id="textfield" /></td>
      </tr>
      <tr>
        <td>ส่วนสูง</td>
        <td align="left"><input type="text" name="high" id="textfield2" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left"><input type="submit" name="button" id="button" value="คำนวน" /></td>
      </tr>
      <tr>
        <td height="29">BMI</td>
        <td align="left">
        <?
		$high=$_POST[high];
		$weight=$_POST[weight];
		$sex=$_POST[sex];

		if($weight<>"" and $high<>"" ){
		$high_m=$high/100;
		$high_2= $high_m*$high_m;//ส่วนสูงกำลัง 2
		$bmi=$weight/$high_2;
		  if($bmi<=19){
		  echo"มีภาวะอ้วนหรือผอม ";
		  }else{
		  if($bmi<=24){
		  echo"มีภาวะปกติ น้ำหนักตัวปกติ  ";
		  }else{
		  if($bmi<=29){
		  echo"น้ำหนักตัวเกินมาตรฐาน (over weight)";
		  }else{
		  if($bmi<=40){
		 echo"มีภาวะอ้วน (obesity)";
		  }
		  }
		  }
		  }



		}
		?>        </td>
      </tr>
      <tr>
        <td height="29">น้ำหนักที่เหมาะสม</td>
        <td align="left"><?
        if($weight<>"" and $high<>"" and $sex <>"" ){
		if($sex=="F" ){
		$weight_appropriate=$high-110;
		echo "$weight_appropriate"."  "."kg";
		}else{
		if($sex=="M"){
		$weight_appropriate=$high-100;
		echo "$weight_appropriate"."  "."kg";
		}
		}
		}
		?></td>
      </tr>
    </table>
      </form>
    </td>
  </tr>
</table>
