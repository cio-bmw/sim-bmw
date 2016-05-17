/* 
	Class Name: T10Doc ( T-10 Document )
	Author: Chandra Jatnika
	Website: chandrajatnika.com
	Description:
	  Kumpulan fungsi sederhana untuk memanupulasi lokasi dokumen 
	  dan mendapatkan module dari lokasi tersebut.
	  Nama module diambil dari string setelah tanda # pada lokasi dokumen.
*/
var T10Doc = Class.create({
 _splitLocation: function(){
	var docLoc = new String(document.location);
	return docLoc.split('#'); // pecah lokasi document berdasar karakter '#'
 },
 getModule: function(){
	var arr = this._splitLocation();
	if(arr.length == 2) 
	 return arr[1]; // nama module adalah string setelah karakter '#'
	else return null;
 }, 
 saveModule: function(moduleName){
	var arr = this._splitLocation();
	/*
	  	Apabila sebelumnya sudah ada nama module maka ganti nama module
		tersebut dengan nama module baru namun apabila lokasi dokumen
		tidak terdapat nama module maka tambahkan #namamodule setelah 
		string lokasi dokumen
	*/
	if(arr.length == 2) document.location = arr[0]+'#'+moduleName;
	else document.location += '#'+moduleName;
 }
});