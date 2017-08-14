<?php
class Define_Constants_Admin {
	
	function __construct()
	{
		define('DC_PLUGIN_URL',WP_CONTENT_URL . '/plugins/define-constants/');
		define('DC_PLUGIN_DIR',WP_PLUGIN_DIR . '/define-constants/');
		add_action('admin_init', array(&$this,'settings_init'));
		add_action('admin_menu', array(&$this,'add_option_page'));
		add_action('admin_print_styles',array(&$this,'add_admin_head'));
		add_filter("plugin_action_links_define-constants/define-constants.php", array(&$this,'add_settings_link'));
	}

	function add_settings_link($links) { 
		$settings_link = '<a href="plugins.php?page=define-constants.php">Settings</a>'; 
		array_unshift($links, $settings_link); 
		return $links; 
	}

	function settings_init()
	{
		register_setting('defined_constants_group', 'defined_constants',array(&$this,'validate_constants'));
	}
	
	function validate_constants($constants)
	{
		
		if(!is_array($constants['name'])) return;
		
		foreach($constants['name'] as $key => $value) {
			if(empty($value)) continue;
			
			$output[] = array(
				'name' => $this->validconstant($value),
				'value' => $constants['value'][$key],
				'desc' => $constants['desc'][$key],
				'internal_warning' => $constants['internal_warning'][$key]
			);
		}

		update_option('defined_constants',$output);	
		
		return $output;
	}
	
	function validconstant($input)
	{
		$output = str_replace(' ','_',$input);
		return strtoupper($output);
	}
	
	
	function add_option_page()
	{
		add_submenu_page('plugins.php','Define Constants', 'Define Constants', 'manage_options', 'define-constants', array(&$this,'define_constants_page'));
	}
	
	function add_admin_head()
	{
		if(isset($_GET['page']) && $_GET['page'] == 'define-constants') {
			wp_enqueue_style('dc_admin_css', DC_PLUGIN_URL.'css/backend.css');
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('dc_admin_js', DC_PLUGIN_URL.'js/backend.js');
		}
	}
	
	function define_constants_page()
	{
		$this->setup_admin_page("Define Constants Settings");
	?>
			<?php $constants = get_option('defined_constants'); 
			if(is_array($constants)) { ?>
				<?php
				if ($_GET['settings-updated']==true) { ?>
					<div id="message" class="updated">
						<p>Constants succesfully updated.</p>
					</div>
				<?php } ?>
				<div class="postbox">
					<h3 class="hndle"><span>Defined Constants</span></h3>
					<div class="inside">
				<form method="post" id="dc_defined_constants_form" action="options.php">
					<?php settings_fields('defined_constants_group'); ?>
					<table class="form-table">
						<thead>
							<tr valign="top">
								<th scope="column"><b>Action</b></th><th scope="column"><b>Name</b></th><th scope="column"><b>Value</b></th><th scope="column"><b>Description</b></th><th><b>Internal Setting?</b></th>
							</tr>
						</thead>
						<tbody id="dc_sortable">
					<?php foreach($constants as $key => $value) : ?>
						<tr valign="top"<?php if(isset($value['internal_warning']) && $value['internal_warning'] == 1) echo ' class="internal_warning" ';?>>
							<td><img class="dc_delete<?php if(isset($value['internal_warning']) && $value['internal_warning'] == 1) echo '_iw';?>" src="<?php echo DC_PLUGIN_URL;?>img/delete.png" title="Delete this constant '<?php echo $value['name']; ?>'" alt="delete" /></td>
							<td><input style="width:250px;" type="text" name="defined_constants[name][]" value="<?php if(isset($value['name'])) echo $value['name']; ?>" /></td>
							<td class="td_textarea">
								<textarea cols="40" rows="5" name="defined_constants[value][]"><?php if(isset($value['value'])) echo $value['value']; ?></textarea>
							</td>
							<td><input style="width:250px;" type="text" name="defined_constants[desc][]" value="<?php if(isset($value['desc'])) echo $value['desc']; ?>" /></td>
							<td>
								<?php if(!isset($value['internal_warning']) || $value['internal_warning'] != 1) { ?><input class="dc_checkbox_hack" type="hidden" name="defined_constants[internal_warning][]" value="0"> <?php } ?>
								<input type="checkbox" class="dc_checkbox" name="defined_constants[internal_warning][]" value="1"<?php if(isset($value['internal_warning']) && $value['internal_warning'] == 1) echo ' checked="checked" ';?>/>
							</td>
						</tr>
					<?php endforeach; ?>
						</tbody>
				</table>
				<p class="submit">
					<input type="submit" class="button-primary" style="margin:5px;" value="<?php _e('Save Changes') ?>" />
				</p>
			</form>
			</div>
			</div>
			<?php } 
			if(!is_array($constants)) $new_index = 0;
				else $new_index = count($constants);
			?>
			<div class="postbox" width="90%">
						<h3 class="hndle"><span>Define a new constant</span></h3>
						<div class="inside">
			<form method="post" action="options.php">
				<?php settings_fields('defined_constants_group'); ?>
				<?php 
				if(is_array($constants)) {
					foreach($constants as $key => $value) : ?>
							<input type="hidden" name="defined_constants[name][]" value="<?php if(isset($value['name'])) echo $value['name']; ?>" />
							<textarea style="display:none;" cols="40" rows="5" name="defined_constants[value][]"><?php if(isset($value['value'])) echo $value['value']; ?></textarea>
							<input type="hidden" name="defined_constants[desc][]" value="<?php if(isset($value['desc'])) echo $value['desc']; ?>" />
							<input type="hidden" name="defined_constants[internal_warning][]" value="<?php if(isset($value['internal_warning'])) echo $value['internal_warning']; ?>" />
				<?php 
						$new_index = $key + 1; 
					endforeach; 
				} ?>
					<table class="form-table">
						<thead>
							<tr valign="top">
								<th scope="column"><b>Name</b></th><th scope="column"><b>Value</b></th><th scope="column"><b>Description</b></th><th><b>Internal setting?</b></th>
							</tr>
						</thead>
						<?php for($i=0;$i<5;$i++) : ?>
						<tr valign="top">
							<td><input style="width:250px;" type="text" name="defined_constants[name][]" /></td>
							<td class="td_textarea">
							<textarea cols="40" rows="5" name="defined_constants[value][]"></textarea>
							</td>
							<td><input style="width:250px;" type="text" name="defined_constants[desc][]" /></td>
							<td>
								<input class="dc_checkbox_hack" type="hidden" name="defined_constants[internal_warning][]" value="0">
								<input class="dc_checkbox" type="checkbox" name="defined_constants[internal_warning][]" value="1" />
							</td>
						</tr>	
						<?php endfor; ?>
				</table>
				<p class="submit">
					<input type="submit" class="button-primary" style="margin:5px;" value="<?php _e('Add') ?>" />
				</p>
			</form>
			</div>
			</div>
		<?php
		$this->close_admin_page();
	}
	
	function setup_admin_page($title)
	{
		?>
		<div class="wrap">
		<h2><?php echo $title; ?></h2>
		<div class="postbox-container" style="width:100%;">
			<div class="metabox-holder">	
				<div class="meta-box-sortables">
		<?php
	}
	
	function close_admin_page()
	{
		?>
		</div></div></div></div>
		<?php
	}
}
