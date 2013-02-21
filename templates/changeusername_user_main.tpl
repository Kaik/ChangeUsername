<h2>{gt text='Change your name'}</h2>

{insert name="getstatusmsg"}
<p id="changeusername_infonote" class="z-informationmsg">
    {gt text="Notice: Please enter your new user name, and then click 'Submit'. Your current user name is <strong>'%s'</strong>." tag1=$coredata.user.uname}
</p>

<form id="changename" class="z-form" action="{modurl modname="ChangeUsername" type="user" func="updateuname"}" method="post">
    <div>
        <input type="hidden" id="changenamelcsrftoken" name="csrftoken" value="{insert name='csrftoken'}" />
        <fieldset>
            <legend>{gt text="Check for availability"}</legend>
            <div class="z-formrow">
                <label for="changeusername_newname">{gt text="Enter new user name"}</label>
                <input id="changeusername_newname" name="newname" value="" />
            </div>
        </fieldset>
     
            <p id="changeusername_checkmessage" class="z-sub">{gt text="Notice: When you are ready, click on 'Submit' to have your new user name checked. If your new name is OK your new user name will be saved."}</p>
            <p id="changeusername_checkmessage_ajax" class="z-hide z-sub">{gt text="Notice: When you are ready, click on 'Check availability' to have your new user name checked. When your entries are OK, click on 'Submit' to save it."}</p>
            <p id="changeusername_validmessage" class="z-hide">{gt text="Your entries seem to be OK. Please click on 'Submit' when you are ready to save new user name."}</p>
            <div class="z-center z-buttons">
                {img id='changeusername_ajax_indicator' class='z-hide' modname=core set='ajax' src='indicator_circle.gif' alt=''}
                {button id='changeusername_submitnewusername' type='submit' src='button_ok.png' set='icons/extrasmall' __alt='Submit' __title='Submit' __text='Submit'}
                {button id='changeusername_checkuserajax' type='button' class='z-hide' src='help.png' set='icons/extrasmall' __alt='Check your entries' __title='Check availability' __text='Check your entries'}
                 <a href="{modurl modname='Users' type='user' func='main'}" title="{gt text='Cancel'}">{img modname=core src=button_cancel.png set=icons/extrasmall  __alt="Cancel" __title="Cancel"} {gt text='Cancel'}</a>
            </div>
    </div>
</form>
