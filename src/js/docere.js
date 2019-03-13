$(function(){
$('.opacity').live('click',function(){return false;});








$(".PhotoUpload_Ajax").live("click", function(e){e.preventDefault();$("#PhotoUpload_Ajax").trigger("click");});

$(".symptomsRemove_ajax").live("click", function(e){e.preventDefault();var t=this,id=$(t).parents(".UsersBox").attr("id");
if(confirm('Are you sure you want to remove?')==false){return false;}
$(t).addClass("opacity");
$.ajax({type:"POST",url:turl+"symptoms/",timeout:15000,data:{symptoms:id},cache:false,success:function(html){
$(t).parents(".UsersBox").slideUp();
},error:function(html){$(t).removeClass("opacity");}});});



$(".AdActionUser_ajax").live("click", function(e){e.preventDefault();var t=this,uid=$(t).parents(".UsersBox").attr("id"),block=$(t).attr("do");
if(confirm('Are you sure you want to perform this action?')==false){return false;}
$(t).addClass("opacity");
$.ajax({type:"POST",url:turl+"users/",timeout:15000,data:{actionuserid:uid,what:block},cache:false,success:function(html){
$(t).fadeOut();
},error:function(html){$(t).removeClass("opacity");}});});




$(".SaveProfileLeaveDoctor_ajax").live("click", function(e){e.preventDefault();
if(confirm('Careful\n\nAre you sure you want apply a leave?\nNOTICE\n\nYour appointments will cancel on that day, cancel notification will send to all patients.\n\n\n')==false){return false;}																			 
$("#SaveProfileLeaveDoctor_ajax").trigger("click");});

$(".LeaveRemove_ajax").live("click", function(e){e.preventDefault();var t=this,tid=$(t).attr("tid");
$(t).addClass("opacity");
$(t).parents(".timeTableRow").slideUp("slow");
$.ajax({type:"POST",url:turl+"profile_save/",timeout:15000,data:{leaveremove:tid},cache:false,success:function(html){

},error:function(html){$(t).removeClass("opacity");}});});



$(".LoadNotifications_ajax").live("click", function(e){e.preventDefault();var t=this;
$(t).addClass("opacity");

$(".NotificationsBox").fadeIn();
$("#LoadNotifications").html('<div align="center" style="font-size:16px;font-weight:bold;padding-bottom:10px;">Loading...</div>');

$.ajax({type:"POST",url:turl+"notifications/",timeout:15000,data:{nload:true},cache:false,success:function(html){
$("html,body").animate({ scrollTop: 350 }, "slow");
$("#LoadNotifications").html(html);
$(t).removeClass("opacity");
},error:function(html){$(t).removeClass("opacity");}});});




$(".AddReview_ajax").live("click", function(e){e.preventDefault();var t=this,uid=$(t).parents(".docBox").attr("id"),AddFeedBack=$(t).parents(".docBox").find("#AddFeedBack").val(),AddStar=$(t).parents(".docBox").find("#AddStar").val();
$(t).addClass("opacity");
$.ajax({type:"POST",url:turl+"appointment/",timeout:15000,data:{addreview:uid,addfeedback:AddFeedBack,addstar:AddStar},cache:false,success:function(html){
$(t).html("Reviewed");
$("#"+uid).fadeOut("slow");
},error:function(html){$(t).removeClass("opacity");}});});


$(".CancelAppointments_ajax").live("click", function(e){e.preventDefault();var t=this,uid=$(t).parents(".docBox").attr("id"),did=$(t).parents(".docBox").attr("did");
if(confirm('Are you sure you want to cancel this appointment?')==false){return false;}
$(t).addClass("opacity");
$.ajax({type:"POST",url:turl+"appointment/",timeout:15000,data:{cancelappointments:uid,did:did},cache:false,success:function(html){
$("#"+uid).fadeOut();
$(t).removeClass("opacity");
},error:function(html){$(t).removeClass("opacity");}});});




$(".LoadAppointments_ajax").live("click", function(e){e.preventDefault();var t=this,type=$(t).attr("id");
$(t).addClass("opacity");

$(".AppointmentsBox").fadeIn();
$("#LoadAppointments").html('<div align="center" style="font-size:16px;font-weight:bold;padding-bottom:10px;">Loading...</div>');

$.ajax({type:"POST",url:turl+"appointment/",timeout:15000,data:{showappointments:type},cache:false,success:function(html){
$("html,body").animate({ scrollTop: 0 }, "slow");
$("#LoadAppointments").html(html);
$(t).removeClass("opacity");
},error:function(html){$(t).removeClass("opacity");}});});




$(".PasswordChange_ajax").live("click", function(e){e.preventDefault();$("#PasswordChange_ajax").trigger("click");});


$("#CalendarSelect_ajax").live("change", function(e){e.preventDefault();var t=this,did=$(t).attr("did"),BigMonth=$(t).val(),IntMonth=$(t).find("."+BigMonth).attr("id");
//$(t).addClass("opacity");
$.ajax({type:"POST",url:turl+"appointment/",timeout:15000,data:{calendar:true,cal_uid:did,cal1:IntMonth,cal2:BigMonth},cache:false,success:function(html){
$("#BookAppointment"+did).html(html);
$(t).removeClass("opacity");
},error:function(html){$(t).removeClass("opacity");}});});


$(".BookAppointment_ajax").live("click", function(e){e.preventDefault();var t=this,did=$(t).parents(".docBox").attr("id");
$(t).addClass("opacity");
$.ajax({type:"POST",url:turl+"appointment/",timeout:15000,data:{calendar:true,cal_uid:did},cache:false,success:function(html){
$("#BookAppointment"+did).html(html);
$(t).removeClass("opacity");
},error:function(html){$(t).removeClass("opacity");}});});











$('.AppointmentActive_ajax').live('click',function(){
var t=this,dateA=$(t).attr("date"),did=$(t).attr("did");
$(t).addClass("opacity");
$.ajax({type:"POST",url:turl+"appointment/",timeout:15000,data:{appointments:dateA,adid:did},cache:false,success:function(html){
window.location.href='';
},error:function(html){$(t).removeClass("opacity");}});});


$('.AppointmentActive').live('click',function(){
var t=this,dateA=$(t).attr("date"),did=$(t).attr("did");



$(".AppointmentActive").removeClass("AppointmentActivated");
$(t).addClass("AppointmentActivated");



$("#Appointment"+did).html('<div style="padding:10px;background-color:#FFFFFF;font-size:16px;font-weight:bold;margin-top:10px;">'+dateA+'<br>Are you sure want to appointment this doctor? <div class="docBut AppointmentActive_ajax" date="'+dateA+'" did="'+did+'" >Yes, Appointment</div></div>');										  
});



$(".TimeRemove_ajax").live("click", function(e){e.preventDefault();var t=this,tid=$(t).attr("tid");
$(t).addClass("opacity");
$(t).parents(".timeTableRow").slideUp("slow");
$.ajax({type:"POST",url:turl+"profile_save/",timeout:15000,data:{timeremove:tid},cache:false,success:function(html){

},error:function(html){$(t).removeClass("opacity");}});});


$(".SaveProfileTimeDoctor_ajax").live("click", function(e){e.preventDefault();$("#SaveProfileTimeDoctor_ajax").trigger("click");});

$(".SymRemove_ajax").live("click", function(e){e.preventDefault();var t=this,sid=$(t).attr("sid");
$(t).addClass("opacity");
$(t).parents(".timeTableRow").slideUp("slow");
$.ajax({type:"POST",url:turl+"profile_save/",timeout:15000,data:{symremove:sid},cache:false,success:function(html){

},error:function(html){$(t).removeClass("opacity");}});});


$(".OpenDocProfile_ajax").live("click", function(e){e.preventDefault();var t=this;
var image=$(t).find(".docImg img").attr("src");
var name=$(t).find(".docTitle span").html();
var services=$(t).attr("services");
var memberships=$(t).attr("memberships");
var about=$(t).attr("about");


$(".ShowProfileImage_ajax").removeClass("PhotoUpload_Ajax");
$(".ShowProfileImage_ajax").attr("src",image);
$(".ShowProfileName_ajax").html(name);
$(".ShowProfileAbout_ajax").html('<div style="margin-top:30px;text-align:left;"><strong>About:</strong><br>'+about+'<br><br><strong>Achievements &amp; Memberships:</strong><br>'+memberships+'<br><br><strong>Services Offered:</strong><br>'+services+'</div>');
});




var symArray=new Array();
$(".FindSymDoctors_ajax").live("click", function(e){e.preventDefault();var t=this,title=$(t).attr("title");
$(t).addClass("opacity");

$("input:checked.SymptomsArray").each(function(){symArray.push($(this).val());});
$(".DoctorsBoxTitle").html("Doctors");
var nsymArray=decodeURIComponent(symArray);

$.ajax({type:"POST",url:turl+"doctors/",timeout:15000,data:{search_doc:nsymArray,bysym:true},cache:false,success:function(html){
$("#LoadDoctors").html(html);
$(t).removeClass("opacity");																									   
},error:function(html){$(t).removeClass("opacity");}});});












$(".SpecialitiesDoctors_ajax").live("click", function(e){e.preventDefault();var t=this,title=$(t).attr("title");
$(t).addClass("opacity");

$(".AppointmentsBox,.NotificationsBox").fadeOut();

$(".DoctorsBoxTitle").html("Doctors - "+title);
$.ajax({type:"POST",url:turl+"doctors/",timeout:15000,data:{search_doc:title},cache:false,success:function(html){
$("html,body").animate({ scrollTop: 250 }, "slow");
$("#LoadDoctors").html(html);
$(t).removeClass("opacity");																									   
},error:function(html){$(t).removeClass("opacity");}});});

$(".SaveProfileDoctor_ajax").live("click", function(e){e.preventDefault();$("#SaveProfileDoctor_ajax").trigger("click");});
$(".SaveGender_ajax").live("click", function(e){e.preventDefault();var t=this,action=$(t).attr("action");
//$(t).addClass("opacity");
$(".EditGender").removeClass("EditGenderActive");
$(t).addClass("EditGenderActive");
$.ajax({type:"POST",url:turl+"profile_save/",timeout:15000,data:{gender:action},cache:false,success:function(html){
},error:function(html){$(t).removeClass("opacity");}});});


$(".showLogin_ajax").live("click", function(e){e.preventDefault();var t=this;
																
$(".showSignup_ajax").removeClass("activeMenu");										
$(t).addClass("activeMenu");														 
																
$(".ActionBox").hide();$(".Login_ajax").show();
});
$(".showSignup_ajax").live("click", function(e){e.preventDefault();var t=this;
																 
$(".showLogin_ajax").removeClass("activeMenu");										
$(t).addClass("activeMenu");												 
																 
$(".ActionBox").hide();$(".Signup_ajax").show();
});
$(".showRecover_ajax").live("click", function(e){e.preventDefault();var t=this;

$(".showLogin_ajax").removeClass("activeMenu");		
$(".showSignup_ajax").removeClass("activeMenu");										

$(".ActionBox").hide();$(".Recover_ajax").show();
});
$(".showAbout_ajax").live("click", function(e){e.preventDefault();var t=this;
$(".ActionBox").hide();$(".About_ajax").show();
});




$(".signup_ajax").live("click", function(e){e.preventDefault();var t=this,
sfname=$("#sfname").val(),slname=$("#slname").val(),
semail=$("#semail").val(),spwd=$("#spwd").val(),
stype=$("#stype").val();

if("Select your profile"==stype)
{
$(".serror").fadeIn().html("Select your profile");
return;
}

$(t).addClass("opacity");
$.ajax({type:"POST",url:turl+"signup/",timeout:15000,data:{sfname:sfname,slname:slname,semail:semail,spwd:spwd,stype:stype},cache:false,success:function(html){
$(t).removeClass("opacity");
if(html!="")$(".serror").fadeIn().html(html);
else
window.location =turl;
},error:function(html){$(t).removeClass("opacity");}});});

$(".login_ajax").live("click", function(e){e.preventDefault();var t=this,login_email=$("#login_email").val(),login_pwd=$("#login_pwd").val();
$(t).addClass("opacity");
$.ajax({type:"POST",url:turl+"login/",timeout:15000,data:{login_email:login_email,login_pwd:login_pwd},cache:false,success:function(html){
$(t).removeClass("opacity");
if(html!="")$(".lerror").fadeIn().html(html);
else
window.location =turl;
},error:function(html){$(t).removeClass("opacity");}});});


$(".passwordCode_ajax").live("click", function(e){e.preventDefault();var t=this,newpassword=$("#newpassword").val(),codepassword=$("#codepassword").val(),emailpassword=$("#emailpassword").val();
$(t).addClass("opacity");
$.ajax({type:"POST",url:turl+"password/",timeout:15000,data:{newpassword:newpassword,codepassword:codepassword,emailpassword2:emailpassword},cache:false,success:function(html){
$(t).removeClass("opacity");
$("#UpdatePasswordCode").fadeIn().html('<div class="LoginBut">Password Updated</div>');
},error:function(html){$(t).removeClass("opacity");}});});

$(".password_ajax").live("click", function(e){e.preventDefault();var t=this,emailpassword=$("#emailpassword").val();
$(t).addClass("opacity");
$.ajax({type:"POST",url:turl+"password/",timeout:15000,data:{emailpassword:emailpassword},cache:false,success:function(html){
$(t).removeClass("opacity");

if(html=="")
{
$(".perror").fadeOut();
$("#UpdatePasswordCode").fadeIn().html('<input type="hidden" id="emailpassword" value="'+emailpassword+'"><input type="password" placeholder="New Password" id="newpassword" maxlength="20"  style="width:100%;border-radius:100px;padding:10px;font-size:14px;background-color:#D6D6D6;"><br><input type="text" placeholder="Enter Code" id="codepassword" maxlength="6"  style="width:100%;border-radius:100px;padding:10px;font-size:14px;background-color:#D6D6D6;"><br><div class="LoginBut passwordCode_ajax">Update</div>');
}
else
$(".perror").fadeIn().html(html);
},error:function(html){$(t).removeClass("opacity");}});});





$(".SiteVisitLoadLists_ajax").live("click", function(e){e.preventDefault();var t=this,href=$(t).attr("href"),action=$(t).attr("action");
$("#SiteVisitLoadLists_ajax").show().html('<div style="padding:30px;text-align:center;"><i class="fa fa-spinner fa-spin" style="color:#000;font-size:25px;"></i></div>');
$(t).addClass("opacity");
$(".tabSite").removeClass("tabActive2");
$(t).addClass("tabActive2");
$.ajax({type:"POST",url:turl+href,timeout:15000,data:{siteaction:action},cache:false,success:function(html){
$("#SiteVisitLoadLists_ajax").html(html);
$(t).removeClass("opacity");
},error:function(html){$(t).removeClass("opacity");}});});














});