<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    
    <?php echo $this->javascript->external();?>    
    
	<title>Oblivion Control</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 15px/20px normal Helvetica, Arial, sans-serif;
		color: #000000;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #822;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 23px;
		font-weight: bold;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}
    
    h2 {
		color: #422;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 20px;
		font-weight: bold;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}
    
    #serverlist,#soundlist,#itemlist {
        font-size: 16px;
        padding: 0px 0px 0px 14px;
    }

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
    
    #submit{
        border-top: 1px solid #D0D0D0;
        margin: 15px 15px 15px 15px;
        padding: 15px 15px 0px 15px;
    }
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Oblivion Control</h1>

	<div id="body">
        <h2>Hosts:</h2>        
        <div>
            <select id="serverlist">            
            <?php foreach($targets as $key => $target):?>                
                <option value="<?php echo $target; ?>"><?php echo $key; ?></option>                
            <?php endforeach; ?>            
            </select>
        </div>
        <h2>Sounds:</h2>
        <div>            
            <select id="soundlist">
            <?php foreach($sounds as $key => $sound):?>
                <option value="<?php echo $sound; ?>"><?php echo $key; ?></option>                                
            <?php endforeach; ?>            
            </select>
        </div>    
	</div>
    <div id="submit">
        <button type='button' name='sendsound' id='sendsound'>Send Sound</button>
    </div>
    
    <div id="body">
        <h2>Spawns:</h2>        
        <div>
            <select id="spawnlist">            
            <?php foreach($spawns as $key => $spawn):?>                
                <option value="<?php echo $spawn; ?>"><?php echo $key; ?></option>                
            <?php endforeach; ?>            
            </select>
        </div>
        <h2>Hostile:</h2>
        <div>            
            <select id="hostilechoice">
            <option value="0">Not Hostile</option>
            <option value="1">Hostile</option>
            </select>
        </div>  
        <h2>Count:</h2>
        <div>
            <select id="countchoice">
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
            <option value="4">Four</option>
            <option value="5">Five</option>
            </select>
        </div>
	</div>
    <div id="submit">
        <button type='button' name='sendspawn' id='sendspawn'>Send Spawn</button>
    </div>
    <div id="body">
        <h2>Message:</h2> 
        <div>         
        <textarea name='textmessage' id='textmessage' cols='128'>
        </textarea>
        </div>
    </div>
    <div id="submit">
        <button type='button' name='sendmessage' id='sendmessage'>Send Message</button>
    </div>    

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<div id='result_table'>
</div>

<script type='text/javascript' language='javascript'>
$('#sendsound').click(function(){
    var postData = {
        'server' : $('#serverlist').val(),
        'command' : "playSound",
        'sound' : $('#soundlist').val()
    };
    $.ajax({
            url: '<?php echo base_url().'site/run_command';?>',
            type:'POST',
            data:postData,
            //dataType: 'json',
            dataType: 'html',
            success: function(output_string){
                    //$('#result_table').append(output_string);
                    //$('#result_table').html(output_string);
                } // End of success function of ajax form
            }); // End of ajax call
});
$('#sendspawn').click(function(){
    var postData = {
        'server' : $('#serverlist').val(),
        'objectref' : $('#spawnlist').val(),
        'command' : "spawnNpc",
        'hostile' : $('#hostilechoice').val(),
        'count' : $('#countchoice').val()
    };
    $.ajax({
            url: '<?php echo base_url().'site/run_command';?>',
            type:'POST',
            data:postData,
            //dataType: 'json',
            dataType: 'html',
            success: function(output_string){
                    //$('#result_table').append(output_string);
                    //$('#result_table').html(output_string);
                } // End of success function of ajax form
            }); // End of ajax call
});
$('#sendmessage').click(function(){
    var postData = {
        'server' : $('#serverlist').val(),
        'command' : 'showMessage',
        'message' : $('#textmessage').val()        
    };
    $.ajax({
            url: '<?php echo base_url().'site/run_command';?>',
            type:'POST',
            data:postData,
            //dataType: 'json',
            dataType: 'html',
            success: function(output_string){
                    //$('#result_table').append(output_string);
                    $('#result_table').html(output_string);
                } // End of success function of ajax form
            }); // End of ajax call
});
</script>

</body>
</html>