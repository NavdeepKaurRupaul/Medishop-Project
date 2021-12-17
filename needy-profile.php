<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>MEDISHOP-NEEDY</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--Title icon-->
	<link rel="shortcut icon" href="pics/icon.png">
	<!--css bootstrap link-->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!--js bootstrap link-->
	<script src="js/bootstrap.bundle.min.js"></script>
	<link rel="shortcut icon" href="pics/icon.png">
	<!--css style-->
	<script src="js/bootstrap.bundle.min.js"></script>
	<!--jquery-->
	<script src="js/jquery-1.8.2.min.js"></script>
	<style>

	</style>
	<!--jquery-->
	<script>
		$(document).ready(function() {
			$("#idtype").change(function() {})
			/**********fetching*************/
			$("#userid").blur(function() {
				//				alert("hi");
				var id = $("#userid").val();
				var url = "ajax-needy-check.php?uid=" + id;
				$.get(url, function(responsex) {
					if (responsex == "Id doesn't exit in our database&#10060;") {
						$("#iderr").html(responsex + " Create New One!!!");
						$("#iderr").css("color", "red");
						$("#fetch").prop("disabled", true);

					} else {
						$("#iderr").html("");
					}
				});
			});
			$("#fetch").click(function() {
				if ($("#userid").val() == "") {
					alert("Enter User Id!!");
					$("#userid").focus();
					return;
				}
				$("#update").prop("disabled", false);
				var uid = $("#userid").val();
				var url = "json-needy.php?uid=" + uid;
				$.getJSON(url, function(returnarray) {
					var i = 0;
					var fname = ""
					while (returnarray[0].name[i] != " ") {
						fname += returnarray[0].name[i];
						i++;
					}
					$("#fname").val(fname);
					var lname = ""
					i++;
					while (i < returnarray[0].name.length) {
						lname += returnarray[0].name[i];
						i++;
					}
					$("#lname").val(lname);
					$("#mob").val(returnarray[0].contact);
					$("#city").val(returnarray[0].city);
					$("#address").val(returnarray[0].address);
					$("#idtype").val(returnarray[0].idtype);
					$("#idnum").val(returnarray[0].idnumb);
					$("#ppicshow").prop("src", "uploads/" + returnarray[0].picpath);
					$("#idpicshow").prop("src", "uploads/" + returnarray[0].idpath);
					$("#pichidden").val(returnarray[0].picpath);
					//					alert($("#pichidden").val());
					$("#idhidden").val(returnarray[0].idpath);
					//					alert($("#idhidden").val());
				});
			});
		});

	</script>
	<script>
		function showpicpreview(file, strId) {
			if (file.files && file.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$(strId).prop('src', e.target.result);
				}
				reader.readAsDataURL(file.files[0]);
			}
		}

		function showidpreview(file, strId) {
			if (file.files && file.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$(strId).prop('src', e.target.result);
				}
				reader.readAsDataURL(file.files[0]);
			}
		}

	</script>
</head>

<body style="background-image: url(pics/medibackground.png)">
	<div class="p-3 mb-2 fixed-top bg-danger text-white" style="font-size: 25px; color: white; font-weight: bold;text-transform: uppercase">
		<div class="row">
			<div class="col-md-11">
				<img src="pics/icon.png" alt="" width="35" height="35" class="d-inline-block align-top">
				MEDISHOP-NEEDY-profile
			</div>
			<div class="col-md-1">
				<a href="logout.php">
					<button class="btn btn-outline-danger bg-warning text-white" type="submit">
						LogOut
					</button>
				</a>
			</div>
		</div>
	</div>
	<form style="margin-left: 65px; margin-top:50px" formaction="needy-process.php" method="post" enctype="multipart/form-data">
		<!--session-->
		<?php
		session_start();//session array is created
	?>
		<!--session end-->
		<div class="container bg-white" style="border: 3px solid #dc3545;margin-top:100px; border-radius:20px">
			<div class="row">
				<div class="col-md-6 mt-2 offset-3">
					<div class="input-group">
						<span class="input-group-text bg-danger text-white border-danger" id="inputGroup-sizing-default">User ID</span>
						<!--user id-->
						<input type="text" value='<?php echo $_SESSION["user"];?>' readonly class="form-control border-danger" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="userid" id="userid" required autocomplete="off">
						<!--fetch-->
						<button class="btn btn-outline-danger bg-danger text-white" type="button" id="fetch">Fetch</button>
					</div>
					<span id="iderr" style="font-weight: bold"></span>
				</div>
			</div>
			<div class="row mt-1">
				<div class="col-md-6 mt-1 border-1">
					<div class="input-group mb-3">
						<!--first name-->
						<span class="input-group-text bg-danger text-white border-danger" id="inputGroup-sizing-default">First Name</span>
						<input type="text" class="form-control border-danger" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="fname" id="fname" required autocomplete="off">
					</div>
				</div>
				<div class="col-md-6 mt-1 border-1">
					<div class="input-group mb-3">
						<!--last name-->
						<span class="input-group-text bg-danger text-white border-danger" id="inputGroup-sizing-default">Last Name</span>
						<input type="text" class="form-control border-danger" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="lname" id="lname" required autocomplete="off">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mt-1 border-1">
					<div class="input-group mb-3">
						<!--address-->
						<span class="input-group-text bg-danger text-white border-danger" id="inputGroup-sizing-default">Address</span>
						<input type="text" class="form-control border-danger" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="address" id="address" required autocomplete="off">
					</div>
				</div>
				<div class="col-md-6 mt-1 border-1">
					<select class="form-select bg-danger text-white text-center w-50" aria-label="Default select example" name="city" id="city" required>
						<option selected>City</option>
						<option value="Patiala">Patiala</option>
						<option value="Sangrur">Sangrur</option>
						<option value="Bathinda">Bathinda</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="input-group mb-3">
						<!--mobile-->
						<span class="input-group-text bg-danger text-white border-danger" id="inputGroup-sizing-default">Mobile Number</span>
						<input type="text" class="form-control border-danger" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="mob" id="mob" required autocomplete="off">
					</div>
				</div>
				<div class="col-md-3">
					<!--id type-->
					<select class="form-select bg-danger text-white text-center" aria-label="Default select example" id="idtype" name="idtype" required>
						<option selected>ID TYPE</option>
						<option value="Adhaar">Adhaar Card</option>
						<option value="Voting">Voting Card</option>
						<option value="Other">Other</option>
					</select>
				</div>
				<div class="col-md-3">
					<!--id number-->
					<div class="input-group mb-3">
						<span class="input-group-text bg-danger text-white border-danger" id="inputGroup-sizing-default">ID NUMBER</span>
						<input type="text" class="form-control border-danger" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="idnum" id="idnum" required autocomplete="off">
					</div>
				</div>
			</div>
			<div class="row">
				<!--hidden pic-->
				<input type="hidden" name="pichidden" id="pichidden">
				<div class="col-md-6 text-center">
					<!--ppic show-->
					<img src="pics/user.jpg" class="rounded " alt="..." width="200px" id="ppicshow" height="194px">
				</div>
				<!--hidden id-->
				<input type="hidden" name="idhidden" id="idhidden">
				<div class="col-md-6 text-center mb-3">
					<!--idpic show-->
					<img src="pics/id-needy.jpg" class="rounded" alt="..." width="200px" height="194px" id="idpicshow">
				</div>
			</div>
			<div class="row">
				<div class="col-md-3" style="margin-left:150px">
					<div class="input-group mb-3">
						<input type="file" class="form-control border-danger" id="inputGroupFile01" accept="image/jpeg, image/png, image/jpg" name="ppic" id="ppic" onchange="showpicpreview(this,ppicshow);">
					</div>
				</div>
				<div class="col-md-3" style="margin-left:270px">
					<div class="input-group mb-3 border-danger">
						<input type="file" class="form-control border-danger" id="inputGroupFile01" accept="image/jpeg, image/png, image/jpg" name="idpic" id="idpic" onchange="showidpreview(this,idpicshow);">
					</div>
				</div>
			</div>
	</form>
	<!--submit-->
	<button style="margin-bottom:10px" class="btn btn-danger text-white w-25 offset-3" style="margin-left:220px; margin-top:px" formaction="needy-process.php" value="Save" name="btn">Save</button>
	<!--update-->
	<button style="margin-bottom:10px" type="submit" class="btn btn-danger text-white w-25" formaction="needy-process.php" id="update" value="Update" name="btn" disabled>Update</button>
	</div>
</body>

</html>
