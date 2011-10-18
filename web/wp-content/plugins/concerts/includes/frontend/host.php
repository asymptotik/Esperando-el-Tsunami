<?php
/**
	* File: host
	* Type: 
* @author Victor L. Facius
	* @version 1.0
	* @package View
	**/
?>
<?php
$output = '
<script type="text/javascript">
	$(document).ready(function() {
		
		$(".initialValue").each(function() {
			$(this).data("od",$(this).val());
			$(this).click(function() {
				if($(this).val() == $(this).data("od")) $(this).val("");
			});
			$(this).blur(function() {
				if($(this).val() == "") $(this).val($(this).data("od"));
			});
		});
				
		$("#host_concert").submit(function() {
			
			var error = false;
			
			$("input.required,select.required").each(function() {
				if($(this).val()=="" || ($(this).hasClass("initialValue")&&$(this).val()==$(this).data("od"))) {
					//$(this).val("---ERROR---");
					//alert($(this).attr("id"));
					error = true;
				}
			});
			
			if(error) {
				alert("Please fill in all fields marked as required");
			}else{
				$("#host_concert").submit();
			}
			
			
			return false;
		});
	});
</script>
<div id="host_concerts">
  <p class="req"><span class="required">*</span> required fields</p>
  <p class="pub"><span class="public">*</span> fields that will be visible to the public on petitesplanetes.cc</p>
  <br />
  <form action="'.str_replace("%7E", "~", $_SERVER["REQUEST_URI"]).'" method="post" name="host_concert" class="validate" id="host_concert">
    <input type="hidden" name="host_concert_post" value="true" />
    <table border="0">
      <tr>
        <td class="label"><label>Place</label>
        <span class="required">*</span><span class="public">*</span></td>
        <td><input class="required initialValue" type="text" id="concert_place" name="concert_place" value="Mike\'s place / Caf&eacute; Luna / etc" alt="Mike\'s place / Caf&eacute; Luna / etc" /></td>
        <td class="label"><label>Additional Info</label>
        <span class="public">*</span></td>
        <td rowspan="2"><textarea name="concert_additional" class="initialValue" id="concert_additional" rows="6" alt="Let your guests know who you are and how you will screen the film? And if they should bring something? etc. ">Let your guests know who you are and how you will screen the film? And if they should bring something? etc. </textarea></td>
      </tr>
      <tr>
        <td class="label"><label>Address</label>
        <span class="required">*</span><span class="public">*</span></td>
        <td><input class="required initialValue" type="text" name="concert_address" id="concert_address" value="Street name &amp; number" alt="Street name &amp; number" />
          <br/>
          <input type="checkbox" name="concert_address_show" value="1" />
          <span class="sub">don\'t make this info visible!</span></td>
        <td class="label"></td>
      </tr>
      <tr>
        <td class="label"><label>City</label>
        <span class="required">*</span><span class="public">*</span></td>
        <td><input class="required initialValue" name="concert_city" id="concert_city" type="text" alt="City" value="City" /></td>
        <td class="label">&nbsp;</td>
        <td><p class="notice"><em>The info below is needed so you are able to log in and manage your event and so we are able to contact you if needed </em></p></td>
      </tr>
      <tr>
        <td class="label"><label>Postal Code</label>
        <span class="required">*</span><span class="public">*</span></td>
        <td><input class="required initialValue" type="text" name="concert_postalcode" id="concert_postalcode" value="Postal Code" alt="Postal Code" /></td>
        <td class="label"><label>Your Name</label>
        <span class="required">*</span></td>
        <td><input class="required initialValue" name="concert_name" id="concert_name" type="text" alt="Name" value="Name" /></td>
      </tr>
      <tr>
        <td class="label"><label>Country</label>
        <span class="required">*</span><span class="public">*</span></td>
        <td><select class="required" name="concert_country" id="concert_country">
            <option selected="selected" value="">select your country</option>
            <option value="AF">AFGHANISTAN</option>
            <option value="AX">ALAND ISLANDS</option>
            <option value="AL">ALBANIA</option>
            <option value="DZ">ALGERIA</option>
            <option value="AS">AMERICAN SAMOA</option>
            <option value="AD">ANDORRA</option>
            <option value="AO">ANGOLA</option>
            <option value="AI">ANGUILLA</option>
            <option value="AQ">ANTARCTICA</option>
            <option value="AG">ANTIGUA AND BARBUDA</option>
            <option value="AR">ARGENTINA</option>
            <option value="AM">ARMENIA</option>
            <option value="AW">ARUBA</option>
            <option value="AU">AUSTRALIA</option>
            <option value="AT">AUSTRIA</option>
            <option value="AZ">AZERBAIJAN</option>
            <option value="BS">BAHAMAS</option>
            <option value="BH">BAHRAIN</option>
            <option value="BD">BANGLADESH</option>
            <option value="BB">BARBADOS</option>
            <option value="BY">BELARUS</option>
            <option value="BE">BELGIUM</option>
            <option value="BZ">BELIZE</option>
            <option value="BJ">BENIN</option>
            <option value="BM">BERMUDA</option>
            <option value="BT">BHUTAN</option>
            <option value="BO">BOLIVIA</option>
            <option value="BA">BOSNIA AND HERZEGOVINA</option>
            <option value="BW">BOTSWANA</option>
            <option value="BV">BOUVET ISLAND</option>
            <option value="BR">BRAZIL</option>
            <option value="IO">BRITISH INDIAN OCEAN TERRITORY</option>
            <option value="BN">BRUNEI DARUSSALAM</option>
            <option value="BG">BULGARIA</option>
            <option value="BF">BURKINA FASO</option>
            <option value="BI">BURUNDI</option>
            <option value="KH">CAMBODIA</option>
            <option value="CM">CAMEROON</option>
            <option value="CA">CANADA</option>
            <option value="CV">CAPE VERDE</option>
            <option value="KY">CAYMAN ISLANDS</option>
            <option value="CF">CENTRAL AFRICAN REPUBLIC</option>
            <option value="TD">CHAD</option>
            <option value="CL">CHILE</option>
            <option value="CN">CHINA</option>
            <option value="CX">CHRISTMAS ISLAND</option>
            <option value="CC">COCOS (KEELING) ISLANDS</option>
            <option value="CO">COLOMBIA</option>
            <option value="KM">COMOROS</option>
            <option value="CG">CONGO</option>
            <option value="CD">CONGO, THE DEMOCRATIC REPUBLIC OF THE</option>
            <option value="CK">COOK ISLANDS</option>
            <option value="CR">COSTA RICA</option>
            <option value="CI">COTE D\'IVOIRE</option>
            <option value="HR">CROATIA</option>
            <option value="CU">CUBA</option>
            <option value="CY">CYPRUS</option>
            <option value="CZ">CZECH REPUBLIC</option>
            <option value="DK">DENMARK</option>
            <option value="DJ">DJIBOUTI</option>
            <option value="DM">DOMINICA</option>
            <option value="DO">DOMINICAN REPUBLIC</option>
            <option value="EC">ECUADOR</option>
            <option value="EG">EGYPT</option>
            <option value="SV">EL SALVADOR</option>
            <option value="GQ">EQUATORIAL GUINEA</option>
            <option value="ER">ERITREA</option>
            <option value="EE">ESTONIA</option>
            <option value="ET">ETHIOPIA</option>
            <option value="FK">FALKLAND ISLANDS (MALVINAS)</option>
            <option value="FO">FAROE ISLANDS</option>
            <option value="FJ">FIJI</option>
            <option value="FI">FINLAND</option>
            <option value="FR">FRANCE</option>
            <option value="GF">FRENCH GUIANA</option>
            <option value="PF">FRENCH POLYNESIA</option>
            <option value="TF">FRENCH SOUTHERN TERRITORIES</option>
            <option value="GA">GABON</option>
            <option value="GM">GAMBIA</option>
            <option value="GE">GEORGIA</option>
            <option value="DE">GERMANY</option>
            <option value="GH">GHANA</option>
            <option value="GI">GIBRALTAR</option>
            <option value="GR">GREECE</option>
            <option value="GL">GREENLAND</option>
            <option value="GD">GRENADA</option>
            <option value="GP">GUADELOUPE</option>
            <option value="GU">GUAM</option>
            <option value="GT">GUATEMALA</option>
            <option value="GN">GUINEA</option>
            <option value="GW">GUINEA-BISSAU</option>
            <option value="GY">GUYANA</option>
            <option value="HT">HAITI</option>
            <option value="HM">HEARD ISLAND AND MCDONALD ISLANDS</option>
            <option value="VA">HOLY SEE (VATICAN CITY STATE)</option>
            <option value="HN">HONDURAS</option>
            <option value="HK">HONG KONG</option>
            <option value="HU">HUNGARY</option>
            <option value="IS">ICELAND</option>
            <option value="IN">INDIA</option>
            <option value="ID">INDONESIA</option>
            <option value="IR">IRAN, ISLAMIC REPUBLIC OF</option>
            <option value="IQ">IRAQ</option>
            <option value="IE">IRELAND</option>
            <option value="IL">ISRAEL</option>
            <option value="IT">ITALY</option>
            <option value="JM">JAMAICA</option>
            <option value="JP">JAPAN</option>
            <option value="JO">JORDAN</option>
            <option value="KZ">KAZAKHSTAN</option>
            <option value="KE">KENYA</option>
            <option value="KI">KIRIBATI</option>
            <option value="KP">KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF</option>
            <option value="KR">KOREA, REPUBLIC OF</option>
            <option value="KW">KUWAIT</option>
            <option value="KG">KYRGYZSTAN</option>
            <option value="LA">LAO PEOPLE\'S DEMOCRATIC REPUBLIC</option>
            <option value="LV">LATVIA</option>
            <option value="LB">LEBANON</option>
            <option value="LS">LESOTHO</option>
            <option value="LR">LIBERIA</option>
            <option value="LY">LIBYAN ARAB JAMAHIRIYA</option>
            <option value="LI">LIECHTENSTEIN</option>
            <option value="LT">LITHUANIA</option>
            <option value="LU">LUXEMBOURG</option>
            <option value="MO">MACAO</option>
            <option value="MK">MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF</option>
            <option value="MG">MADAGASCAR</option>
            <option value="MW">MALAWI</option>
            <option value="MY">MALAYSIA</option>
            <option value="MV">MALDIVES</option>
            <option value="ML">MALI</option>
            <option value="MT">MALTA</option>
            <option value="MH">MARSHALL ISLANDS</option>
            <option value="MQ">MARTINIQUE</option>
            <option value="MR">MAURITANIA</option>
            <option value="MU">MAURITIUS</option>
            <option value="YT">MAYOTTE</option>
            <option value="MX">MEXICO</option>
            <option value="FM">MICRONESIA, FEDERATED STATES OF</option>
            <option value="MD">MOLDOVA, REPUBLIC OF</option>
            <option value="MC">MONACO</option>
            <option value="MN">MONGOLIA</option>
            <option value="MS">MONTSERRAT</option>
            <option value="MA">MOROCCO</option>
            <option value="MZ">MOZAMBIQUE</option>
            <option value="MM">MYANMAR</option>
            <option value="NA">NAMIBIA</option>
            <option value="NR">NAURU</option>
            <option value="NP">NEPAL</option>
            <option value="NL">NETHERLANDS</option>
            <option value="AN">NETHERLANDS ANTILLES</option>
            <option value="NC">NEW CALEDONIA</option>
            <option value="NZ">NEW ZEALAND</option>
            <option value="NI">NICARAGUA</option>
            <option value="NE">NIGER</option>
            <option value="NG">NIGERIA</option>
            <option value="NU">NIUE</option>
            <option value="NF">NORFOLK ISLAND</option>
            <option value="MP">NORTHERN MARIANA ISLANDS</option>
            <option value="NO">NORWAY</option>
            <option value="OM">OMAN</option>
            <option value="PK">PAKISTAN</option>
            <option value="PW">PALAU</option>
            <option value="PS">PALESTINIAN TERRITORY, OCCUPIED</option>
            <option value="PA">PANAMA</option>
            <option value="PG">PAPUA NEW GUINEA</option>
            <option value="PY">PARAGUAY</option>
            <option value="PE">PERU</option>
            <option value="PH">PHILIPPINES</option>
            <option value="PN">PITCAIRN</option>
            <option value="PL">POLAND</option>
            <option value="PT">PORTUGAL</option>
            <option value="PR">PUERTO RICO</option>
            <option value="QA">QATAR</option>
            <option value="RE">REUNION</option>
            <option value="RO">ROMANIA</option>
            <option value="RU">RUSSIAN FEDERATION</option>
            <option value="RW">RWANDA</option>
            <option value="SH">SAINT HELENA</option>
            <option value="KN">SAINT KITTS AND NEVIS</option>
            <option value="LC">SAINT LUCIA</option>
            <option value="PM">SAINT PIERRE AND MIQUELON</option>
            <option value="VC">SAINT VINCENT AND THE GRENADINES</option>
            <option value="WS">SAMOA</option>
            <option value="SM">SAN MARINO</option>
            <option value="ST">SAO TOME AND PRINCIPE</option>
            <option value="SA">SAUDI ARABIA</option>
            <option value="SN">SENEGAL</option>
            <option value="CS">SERBIA AND MONTENEGRO</option>
            <option value="SC">SEYCHELLES</option>
            <option value="SL">SIERRA LEONE</option>
            <option value="SG">SINGAPORE</option>
            <option value="SK">SLOVAKIA</option>
            <option value="SI">SLOVENIA</option>
            <option value="SB">SOLOMON ISLANDS</option>
            <option value="SO">SOMALIA</option>
            <option value="ZA">SOUTH AFRICA</option>
            <option value="GS">SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS</option>
            <option value="ES">SPAIN</option>
            <option value="LK">SRI LANKA</option>
            <option value="SD">SUDAN</option>
            <option value="SR">SURINAME</option>
            <option value="SJ">SVALBARD AND JAN MAYEN</option>
            <option value="SZ">SWAZILAND</option>
            <option value="SE">SWEDEN</option>
            <option value="CH">SWITZERLAND</option>
            <option value="SY">SYRIAN ARAB REPUBLIC</option>
            <option value="TW">TAIWAN, PROVINCE OF CHINA</option>
            <option value="TJ">TAJIKISTAN</option>
            <option value="TZ">TANZANIA, UNITED REPUBLIC OF</option>
            <option value="TH">THAILAND</option>
            <option value="TL">TIMOR-LESTE</option>
            <option value="TG">TOGO</option>
            <option value="TK">TOKELAU</option>
            <option value="TO">TONGA</option>
            <option value="TT">TRINIDAD AND TOBAGO</option>
            <option value="TN">TUNISIA</option>
            <option value="TR">TURKEY</option>
            <option value="TM">TURKMENISTAN</option>
            <option value="TC">TURKS AND CAICOS ISLANDS</option>
            <option value="TV">TUVALU</option>
            <option value="UG">UGANDA</option>
            <option value="UA">UKRAINE</option>
            <option value="AE">UNITED ARAB EMIRATES</option>
            <option value="GB">UNITED KINGDOM</option>
            <option value="US">UNITED STATES</option>
            <option value="UM">UNITED STATES MINOR OUTLYING ISLANDS</option>
            <option value="UY">URUGUAY</option>
            <option value="UZ">UZBEKISTAN</option>
            <option value="VU">VANUATU</option>
            <option value="VE">VENEZUELA</option>
            <option value="VN">VIET NAM</option>
            <option value="VG">VIRGIN ISLANDS, BRITISH</option>
            <option value="VI">VIRGIN ISLANDS, U.S.</option>
            <option value="WF">WALLIS AND FUTUNA</option>
            <option value="EH">WESTERN SAHARA</option>
            <option value="YE">YEMEN</option>
            <option value="ZM">ZAMBIA</option>
            <option value="ZW">ZIMBABWE</option>
          </select></td>
        <td class="label"><label>Your Email</label>
        <span class="required">*</span></td>
        <td><input class="required initialValue" name="concert_email" id="concert_email" type="text" alt="your@e-mail.com" value="your@e-mail.com" /></td>
      </tr>
      <tr>
        <td class="label"><label>Date &amp; Time</label>
        <span class="required">*</span><span class="public">*</span></td>
        <td><input class="required datepicker" type="text" name="concert_date" id="concert_date" value="28/02/2011" /> <input class="required timepicker" type="text" name="concert_time" id="concert_time" value="20:00" /></td>
        <td class="label"><label>Your Password</label>
        <span class="required">*</span></td>
        <td><input class="required initialValue" name="concert_password" id="concert_password" type="password" alt="password" value="password" /></td>
      </tr>
      <tr>
        <td class="label"><label>Maximum attendants</label>
        <span class="required">*</span><span class="public">*</span></td>
        <td><input id="concert_max" class="required number initialValue" type="text" name="concert_max" id="concert_max" value="Maximum Attendants" alt="Maximum Attendants" />
          <br/>
          <input type="checkbox" name="concert_status" value="1" />
          <span class="sub">Already fully booked</span></td>
        <td class="label"><label>Your Phone</label><span class="required">*</span></td>
        <td><input class="required phone initialValue" name="concert_phone" id="concert_phone" type="text" alt="(countrycode) + number" value="(countrycode) + number" /></td>
      </tr>
    </table>
    <input type="submit" class="submit" id="submit" value="SEND" />
    <!--<input id="submit" type="image" src="http://petitesplanetes.cc/home/wp-content/themes/anisland/images/btnsubmit.jpg" />-->
  </form>
</div>';

return $output;
?>