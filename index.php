<?php

class_exists('CApi') or die();

class CConradChangeLoginDetailsPlugin extends AApiPlugin
{
	/**
	 * @param CApiPluginManager $oPluginManager
	 */
	public function __construct(CApiPluginManager $oPluginManager)
	{
		parent::__construct('1.0', $oPluginManager);

		$this->AddHook('api-integrator-login-to-account', 'PluginIntegratorLoginToAccount');
	}

	private function convertEmailToLogin($sEmail)
	{
		$sResult = $sEmail;
		
		$iPos = strrpos($sEmail, '.');
		if (false !== $iPos && 0 < $iPos)
		{
			$sResult = substr($sResult, 0, $iPos);
		}
		
		return str_replace('@', '.', $sResult);
	}
	
	/**
	 * @param string $sEmail
	 * @param string $sIncPassword
	 * @param string $sIncLogin
	 * @param string $sLanguage
	 * @param bool $bAuthResult
	 */
	public function PluginIntegratorLoginToAccount(&$sEmail, &$sPassword, &$sLogin, &$sLanguage, &$bAuthResult)
	{
		if (empty($sLogin))
		{
			$sLogin = $this->convertEmailToLogin($sEmail);
		}
		else
		{
			$sLogin = $this->convertEmailToLogin($sLogin);
		}
	}
}

return new CConradChangeLoginDetailsPlugin($this);
