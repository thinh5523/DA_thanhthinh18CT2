var kickThuoc = document.getElementsByClassName("slide")[0].clientWidth;
var ChuyenSlide = document.getElementsByClassName("chuyen-slide")[0];
var Img = ChuyenSlide.getElementsByTagName("img");
var Max = kickThuoc + 4000;
Max -= kickThuoc;
var Chuyen = 0;
function Next(){
	if(Chuyen < Max) Chuyen += kickThuoc;
	else Chuyen = 0;
	ChuyenSlide.style.marginLeft = '-' + Chuyen + 'px';
}
function Back(){
	if(Chuyen == 0) Chuyen = Max;
	else Chuyen -= kickThuoc;
	ChuyenSlide.style.marginLeft = '-' + Chuyen + 'px';
}
setInterval(function() {
	Next();
}, 3000);
