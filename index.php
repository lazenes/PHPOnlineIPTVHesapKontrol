<!DOCTYPE html>
<html lang="en">
<head>
  <title>IPTV Hesap Kontrol</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/jquery-1.7.js"></script>
<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>

<style>
body {
    font-family: 'Raleway';font-size: 16px;

  background-color: black;
  color: orange;
}
@media screen and (prefers-color-scheme: light) {
  body {
    background-color: black;
     color: orange;
  }
}
	input[type="text"], textarea {

  background-color : #d1d1d1; 
  color: black;
}
</style>
</head>
<body>

<div class="container">
	<div class="modal fade" tabindex="-1" role="dialog" id="bagisyap">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Bağış Yap!</h4>		
      </div>
      <div class="modal-body">
		    Bağışta Bulunana Herkese Bu Php Scriptin Bir Kopyasını Açık Kaynak Olarak Paylaşacağım 
	
     	  <div class="view view-first">
			  <img style="max-width: 100%;" src="https://hesapno.com/assets/img/papara.gif" alt="">
			 <div id="55364" style="cursor:text" class="descr">

									<h4>PAPARA HESABI</h4>
				 
				
				 <div style="clear: both"><hr>
				 </div>
               <ul>
				<li>
				<strong>Papara Numarası: </strong>{HesaPNo}</li>									
				 </ul>
				 <hr>
			  </div>
		  </div>
      </div>
      <div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>       
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

  <h2>IPTV Kontrol v1</h2>
	<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
  <button type="button" data-toggle="modal" data-target="#bagisyap" class="btn btn-secondary">Bağış Yap</button>
  <button type="button" data-toggle="modal" data-target="#fiyatlar" class="btn btn-secondary">IPTV Satınal</button>
</div>
<div align="center"><div data-ti="169216_195366"></div></div>

	  
	
	<br>
	
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"> İPTV Url Adresleri</h3>
  </div>
  <div class="panel-body">
    <textarea id='keywords' class="text" style="width:100%" rows ="10" name="keywords"></textarea>
 
	  
 
 
 

<div class="input-group">
   <input type="submit" value="Kontrol Et!" id="data" class="btn btn-success">

	<textarea style="width:100%; display:none " id="t"></textarea>

	 <button class="btn btn-info" id="indir" style="display:none;margin-left: 8px !important;" onclick="ayikla();saveTextAsFile(t.value,'IPTvListesi.txt')"> İndir(.txt)</button>
	<button type="button" style="margin-left: 8px !important;" class="btn btn-danger" data-toggle="collapse" data-target="#neisyapar">Ne işe Yarar?</button>
  <div id="neisyapar" class="collapse">
 <p> Girmiş olduğunuz hesapları kontrol eder çalışanları ayıklar ve tabloya ekler dilerseniz çalışan hesapların url adreslerini bir .txt dosyasına çevirtip indirte bilirsiniz
 </p>
  </div>
	
</div>
	  </div>
</div> 
	<br>
	<p>İlerleme:
 </p>
	 <div class="progress progress-striped active ">
        <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
        </div>
    </div>
	
	<table  id="saglamIpTvler" class="table">
    <thead>
      <tr>
        <th>Adres</th>
        <th>Kullanıcı Adı</th>
        <th>Şifre</th>
        <th>Kalan Süre</th>
		<th>Desteklenen Format</th>
        <th>Durum</th>
		<th>İndir</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
<script type="text/javascript">//<![CDATA[
	
	
	
	
	function ayikla(){

		$("#saglamIpTvler a").each(function ()
 {
   $('#t').val($('#t').val()+$(this).attr('href')+"\n");
 
});
		
}

	$(window).load(function(){
      
  (function($){
     $(document).ready(function(){
        $('#data').click(function(e){
			e.preventDefault();
			$("#saglamIpTvler td").parent().remove();

         var ks = $('#keywords').val().split("\n");   
		 var yuzde=0;	
			for (var i = 0; i < ks.length; i++) {
    (function(i) {	
		$.post("ajax.php", {iptvadresi:ks[i] }, function(data){	
			if(data.length >0){				
			setTimeout(function() { $('#saglamIpTvler').append(data);								  
		    yuzde = yuzde + Math.ceil(100/ks.length);
		 $('.progress-bar').css('width', yuzde+'%').attr('aria-valuenow', yuzde);}, 1000* i);
				$('#indir').show();
			} 
		});
	
	})(i);
				
}
  
 
        });
     });
  })(jQuery);
 });



  
	 function saveTextAsFile(textToWrite, fileNameToSaveAs)
    { 	
      

    	var textFileAsBlob = new Blob([textToWrite], {type:'text/plain'}); 
    	var downloadLink = document.createElement("a");
    	downloadLink.download = fileNameToSaveAs;
    	downloadLink.innerHTML = "Download File";
    	if (window.webkitURL != null)
    	{
    		// Chrome allows the link to be clicked
    		// without actually adding it to the DOM.
    		downloadLink.href = window.webkitURL.createObjectURL(textFileAsBlob);
    	}
    	else
    	{
    		// Firefox requires the link to be added to the DOM
    		// before it can be clicked.
    		downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
    		downloadLink.onclick = destroyClickedElement;
    		downloadLink.style.display = "none";
    		document.body.appendChild(downloadLink);
    	}
    
    	downloadLink.click();
	
      }
	
	//]]></script>
<div class="modal fade " tabindex="-1" role="dialog" id="fiyatlar">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Bağış Yap!</h4>		
      </div>
      <div class="modal-body">
		<div class="row">
			Almak İstediğiniz Paketin Tutarını Papara {HesaPNo} Hesap Numarasına Açıklama kısmına mail adresiniziz yazarak Gönderin Hesabınız 15dk İçerisinde Mail Olarak  elsin ;) 
			<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
					<!-- PRICE ITEM -->
					<div class="panel price panel-red">
						<div class="panel-heading  text-center">
						<h3>GÜNLÜK</h3>
						</div>
						<div class="panel-body text-center">
							<p class="lead" style="font-size:40px"><strong>2₺/Günlük</strong></p>
						</div>
						<ul class="list-group list-group-flush text-center">
							<li class="list-group-item"><i class="icon-ok text-danger"></i>Ulusal ve VIP Kanalar</li>
							<li class="list-group-item"><i class="icon-ok text-danger"></i>Kesintisiz ve 4k Kalitesinde Yayın</li>
							<li class="list-group-item"><i class="icon-ok text-danger"></i></li>
						</ul>
						<div class="panel-footer">
							<a class="btn btn-lg btn-block btn-danger" href="#">SATIN AL!</a>
						</div>
					</div>
					<!-- /PRICE ITEM -->	
				</div>		
<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
					<!-- PRICE ITEM -->
					<div class="panel price panel-red">
						<div class="panel-heading  text-center">
						<h3>HAFTALIK </h3>
						</div>
						<div class="panel-body text-center">
							<p class="lead" style="font-size:40px"><strong>5₺/7Gün</strong></p>
						</div>
						<ul class="list-group list-group-flush text-center">
							<li class="list-group-item"><i class="icon-ok text-danger"></i>Ulusal ve VIP Kanalar</li>
							<li class="list-group-item"><i class="icon-ok text-danger"></i>Kesintisiz ve 4k Kalitesinde Yayın</li>
							<li class="list-group-item"><i class="icon-ok text-danger"></i></li>
						</ul>
						<div class="panel-footer">
							<a class="btn btn-lg btn-block btn-warning" href="#">SATIN AL!</a>
						</div>
					</div>
					<!-- /PRICE ITEM -->	
				</div>				
				<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">				
					<!-- PRICE ITEM -->
					<div class="panel price panel-blue">
						<div class="panel-heading arrow_box text-center">
						<h3>AYLIK</h3>
						</div>
						<div class="panel-body text-center">
							<p class="lead" style="font-size:40px"><strong>20₺/Aylık</strong></p>
						</div>
						<ul class="list-group list-group-flush text-center">
							<li class="list-group-item"><i class="icon-ok text-danger"></i>Ulusal ve VIP Kanalar</li>
							<li class="list-group-item"><i class="icon-ok text-danger"></i>Kesintisiz ve 4k Kalitesinde Yayın</li>
							<li class="list-group-item"><i class="icon-ok text-danger"></i>Kampanya!</li>
						</ul>
						<div class="panel-footer">
							<a class="btn btn-lg btn-block btn-info" href="#">SATIN AL!</a>
						</div>
					</div>
					<!-- /PRICE ITEM -->				
				</div>				
			
						</div>
				
	

     	</div>
      </div>
      <div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>       
      </div>
    </div>
  </div>

	
	</body>
</html>


