 <?php


if ( ! function_exists('lang'))
{
	
	function lang($line, $for = '', $attributes = array())
	{
		$token_line = $line;
		$line = get_instance()->lang->line($line, $log_errors = TRUE);

		if(empty($line))
		{
			$line = ucfirst(str_replace('_',' ',$token_line));
		}

		if ($for !== '')
		{
			$line = '<label for="'.$for.'"'._stringify_attributes($attributes).'>'.$line.'</label>';
		}
		
		return $line ? $line : $token_line;
	}
}
