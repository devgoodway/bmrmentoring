// opener관련 오류가 발생하는 경우 아래 주석을 해지하고, 사용자의 도메인정보를 입력합니다. ("팝업API 호출 소스"도 동일하게 적용시켜야 합니다.)
// document.domain = "mrgoodway.cafe24.com";

function jusoCallBack(roadFullAddr,roadAddrPart1,addrDetail,roadAddrPart2,engAddr,jibunAddr,zipNo,admCd,rnMgtSn,bdMgtSn,detBdNmList,bdNm,bdKdcd,siNm,sggNm,emdNm,liNm,rn,udrtYn,buldMnnm,buldSlno,mtYn,lnbrMnnm,lnbrSlno,emdNo){
	// document.getElementById('roadFullAddr').value = roadFullAddr;
	document.getElementById('roadAddrPart1').value = roadAddrPart1;
	document.getElementById('addrDetail').value = addrDetail;
	// document.getElementById('roadAddrPart2').value = roadAddrPart2;
	// document.getElementById('engAddr').value = engAddr;
	// document.getElementById('jibunAddr').value = jibunAddr;
	document.getElementById('zipNo').value = zipNo;
	// document.getElementById('admCd').value = admCd;
	// document.getElementById('rnMgtSn').value = rnMgtSn;
	// document.getElementById('bdMgtSn').value = bdMgtSn;
	// document.getElementById('detBdNmList').value = detBdNmList;
	//** 2017년 2월 제공항목 추가 **/
	// document.getElementById('bdNm').value = bdNm;
	// document.getElementById('bdKdcd').value = bdKdcd;
	document.getElementById('siNm').value = siNm;
	// document.getElementById('sggNm').value = sggNm;
	// document.getElementById('emdNm').value = emdNm;
	// document.getElementById('liNm').value = liNm;
	// document.getElementById('rn').value = rn;
	// document.getElementById('udrtYn').value = udrtYn;
	// document.getElementById('buldMnnm').value = buldMnnm;
	// document.getElementById('buldSlno').value = buldSlno;
	// document.getElementById('mtYn').value = mtYn;
	// document.getElementById('lnbrMnnm').value = lnbrMnnm;
	// document.getElementById('lnbrSlno').value = lnbrSlno;
	//** 2017년 3월 제공항목 추가 **/
	// document.getElementById('emdNo').value = emdNo;
}

function goPopup(){
	// 주소검색을 수행할 팝업 페이지를 호출합니다.
	// 호출된 페이지(jusoPopup_utf8.php)에서 실제 주소검색URL(http://www.juso.go.kr/addrlink/addrLinkUrl.do)를 호출하게 됩니다.
	var pop = window.open("vendor/juso/jusoPopup_utf8.php","pop","width=570,height=420, scrollbars=yes, resizable=yes"); 
	
	// 모바일 웹인 경우, 호출된 페이지(jusoPopup_utf8.php)에서 실제 주소검색URL(http://www.juso.go.kr/addrlink/addrMobileLinkUrl.do)를 호출하게 됩니다.
    //var pop = window.open("/jusoPopup_utf8.php","pop","scrollbars=yes, resizable=yes"); 
}