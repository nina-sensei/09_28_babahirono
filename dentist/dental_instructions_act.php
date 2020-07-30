<?php
// var_dump($_POST);
// exit();
session_start();
// 関数ファイル読み込み
include('../functions.php');
check_session_id();

// データ受け取り
$dentist_id = $_POST["dentist_id"];
$laboratory = $_POST["laboratory"];
$patient_name = $_POST["patient_name"];
$patient_kana = $_POST["patient_kana"];
$patient_sex = $_POST["patient_sex"];
$patient_birthday = $_POST["patient_birthday"];
$insurance = $_POST["insurance"];
$delivery_date = $_POST["delivery_date"];
$product = $_POST["product"];
// $upload = $_POST['upload'];

// var_dump($upload);
// exit;

if (isset($_POST['material']) && is_array($_POST['material'])) {
   $material = implode(",", $_POST["material"]);
}

// 値が存在しないor空で送信されてきた場合はNGにする
if (
   !isset($laboratory) || $laboratory == "" ||
   !isset($patient_name) || $patient_name == "" ||
   !isset($patient_kana) || $patient_kana == "" ||
   !isset($patient_sex) || $patient_sex == "" ||
   !isset($patient_birthday) || $patient_birthday == "" ||
   !isset($insurance) || $insurance == "" ||
   !isset($delivery_date) || $delivery_date == "" ||
   !isset($product) || $product == "" ||
   !isset($material) || $material == ""
) {
   echo json_encode(["error_msg" => "no input"]);
   exit();
}


// ここからファイルアップロード&DB登録の処理
if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0) {
   // アップロードしたファイル名を取得.
   // 一時保管しているtmpフォルダの場所の取得.
   // アップロード先のパスの設定(サンプルではuploadフォル全くダ同←じ作成!)
   $uploadedFileName = $_FILES['upfile']['name']; //ファイル名の取得 
   $tempPathName = $_FILES['upfile']['tmp_name']; //tmpフォルダの場所 
   $fileDirectoryPath = '../upload/';

   // ファイルの拡張子の種類を取得.
   // ファイルごとにユニークな名前を作成.(最後に拡張子を追加) // ファイルの保存場所をファイル名に追加. 全く同じ!
   $extension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);
   $uniqueName = date('YmdHis') . md5(session_id()) . "." . $extension;
   $fileNameToSave = $fileDirectoryPath . $uniqueName;
} else {
   // 送られていない，エラーが発生，などの場合
   exit('Error:画像が送信されていません');
}



if (is_uploaded_file($tempPathName)) {
   if (move_uploaded_file($tempPathName, $fileNameToSave)) {
      chmod($fileNameToSave, 0644);
      $pdo = connect_to_db();
      $sql = 'INSERT INTO instructions_form(id, dentist_id, laboratory, patient_name, patient_kana, patient_sex, patient_birthday, insurance, order_date, delivery_date, product, material, image, created_at) 
                              VALUES(NULL, :dentist_id, :laboratory, :patient_name, :patient_kana, :patient_sex, :patient_birthday, :insurance, curdate(), :delivery_date, :product, :material, :image, sysdate())';

      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':dentist_id', $dentist_id, PDO::PARAM_STR);
      $stmt->bindValue(':laboratory', $laboratory, PDO::PARAM_STR);
      $stmt->bindValue(':patient_name', $patient_name, PDO::PARAM_STR);
      $stmt->bindValue(':patient_kana', $patient_kana, PDO::PARAM_STR);
      $stmt->bindValue(':patient_sex', $patient_sex, PDO::PARAM_STR);
      $stmt->bindValue(':patient_birthday', $patient_birthday, PDO::PARAM_STR);
      $stmt->bindValue(':insurance', $insurance, PDO::PARAM_STR);
      $stmt->bindValue(':delivery_date', $delivery_date, PDO::PARAM_STR);
      $stmt->bindValue(':product', $product, PDO::PARAM_STR);
      $stmt->bindValue(':material', $material, PDO::PARAM_STR);
      $stmt->bindValue(':image', $fileNameToSave, PDO::PARAM_STR);
      $status = $stmt->execute();
   } else {
      exit('Error:アップロードできませんでした'); // 画像の保存に失敗
   }
} else {
   exit('Error:画像がありません'); //tmpフォルダにデータがない 
}

// データ登録処理後
if ($status == false) {
   // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
   $error = $stmt->errorInfo();
   echo json_encode(["error_msg" => "{$error[2]}"]);
   exit();
} else {
   // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
   header("Location:dentist_top.php");
   exit();
}

