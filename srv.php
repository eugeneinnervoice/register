<?php
$result=array("status"=>true,"answer"=>array());
$users=array();
$users["mail0@gmail.com"]=array("id"=>"1", "email"=>"mail0@gmail.com","name"=>"name0");
$users["mail1@gmail.com"]=array("id"=>"2", "email"=>"mail1@gmail.com","name"=>"name1");
$users["mail2@gmail.com"]=array("id"=>"3", "email"=>"mail2@gmail.com","name"=>"name2");
$users["mail3@gmail.com"]=array("id"=>"4", "email"=>"mail3@gmail.com","name"=>"name3");
$users["mail4@gmail.com"]=array("id"=>"5", "email"=>"mail4@gmail.com","name"=>"name4");
$users["e14@ksoft.com.ua"]=array("id"=>"5", "email"=>"mail4@gmail.com","name"=>"name4");


if (isset($_POST["email"])&&(strlen($_POST["email"])>0))
	{
		if (strpos($_POST["email"], "@")===false)
			{
				$result["status"]=false;
				$result["answer"][]="Електронна адреса повинна містити в собі \"@\"";
			}
		else
			{
				$file=fopen("log.txt","a");
				if (key_exists($_POST["email"],$users))
					{
						$result["status"]=false;
						$result["answer"][]="Електронна адреса \"{$_POST["email"]}\" вже використовується";
						$str=$_POST["email"]."\t"."exists";
					}
				else
					{
						$str=$_POST["email"]."\t"."does not exist";
					} 	
				
				$datetime=new DateTime();
				$str=$datetime->format("Y-m-d h:i:s")."\t".$str."\r\n";
				fwrite($file,$str);	
				fclose($file);
			}
	}
else
	{
		$result["status"]=false;
		$result["answer"][]="Не введена електронна адреса.";
	}	
	



if ((isset($_POST["pswd"]))&&(isset($_POST["pswd"])))
	{
		if ((strlen($_POST["pswd"])>0)&&(strlen($_POST["confirmPswd"])>0))
			{
				if ($_POST["pswd"]!=$_POST["confirmPswd"])
					{
						$result["status"]=false;
						$result["answer"][]="Поля пароль та підтвердження пароля не співпадають.";
					}	
			}
		else
			{
				$result["status"]=false;
				$result["answer"][]="Не введене поле пароль або підтвердження пароля";
			}
			
	}
else
	{
		$result["status"]=false;
		$result["answer"][]="Не введене поле пароль або підтвердження пароля";
		
	}
	
if ($result["status"]==true)
	{
		$result["answer"][]="Ви зареєстровані.";
	}	
	
echo json_encode($result);