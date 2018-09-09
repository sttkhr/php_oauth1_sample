<?php
/**
 * @author as_chachamaru
 * @see <a href="http://it-ambition.al5rithm.info/category/php-pecl-oauth-provider/">ちゃちゃ丸 IT技術 向上奮闘記</a>
 */
class Sample_oatuh_provider
{
	private $provider;

	public function __construct()
	{
		$this->provider = new OAuthProvider();
		//Consumerキー (oauth_consumer_key) を検証するコールバックを指定
		$this->provider->consumerHandler(array($this,'consumer_callback'));
		//タイムスタンプ (oauth_timestamp) と ノンス (oauth_nonce) を検証するコールバックを指定
		$this->provider->timestampNonceHandler(array($this,'timestamp_nonce_callback'));
		//トークン (oauth_token) を検証するコールバックを指定
		$this->Provider->tokenHandler(array($this,'check_token_callback'));
	}

	/**
	 * Consumer のチェック
	 * 
	 * APIの利用者 Comsumer は APIを提供する Service Provider に
	 * あらかじめ Consumer として登録します。
	 * 
	 * そして Service Providerは Consumer に Consumer Key と Consumer Secret
	 * を発行します。
	 * 
	 * リクエストには Consumer Key が含まれているため、Consumer Key から 
	 * Consumer として登録されているか確認します。
	 * 
	 * Consumer Key に該当する Consumer が存在しなければ 
	 * エラーコード：OAUTH_CONSUMER_KEY_UNKNOWN を返します。
	 * 
	 * Consumer が存在すれば、Consumer Secret を取得し OAuthProviderインスタンスの
	 * consumer_secretプロパティにセットします。
	 * この Consumer Secret は署名検証に利用されます。
	 * 
	 * Comsumerチェックで問題がなければ OAUTH_OK を返します。
	 * 
	 * 
	 * @return OAUTH_OK
	 *         OAUTH_CONSUMER_KEY_UNKNOWN
	 * 
	 * @see <a href="http://php.net/manual/ja/oauth.constants.php">PHP: 定義済み定数 - Manual</a>
	 */
	public function consumer_callback()
	{
		/**
		 *  Consumerチェック NG の場合
		 */
		//return OAUTH_CONSUMER_KEY_UNKNOWN;

		 /**
		  * Consumerチェック OK の場合
		  */ 
		$this->provider->consumer_secret = CONSUMER_SECRET;
		return OAUTH_OK;
	}

	/**
	 * タイムスタンプとノンスのチェック
	 * 
	 * [タイムスタンプ]
	 * リクエストにタイムスタンプが含まれています。
	 * 多くはリクエスト送信日時のタイムスタンプを値として使っています。
	 * 
	 * リクエスト受信時のサーバ時間とリクエストのタイプスタンプとの差
	 * を比較して未来時間や一定期間経過してたらエラーにするなどに使います。
	 * 
	 * チェックエラー： OAUTH_BAD_TIMESTAMP を返します。
	 * 
	 * [ノンス]
	 * ノンスはConsumerによって生成されたユニークなランダムな文字列です。
	 * Service Provider は リクエストで受信したノンスを保存しておき
	 * 既に受信済みのリクエストでないかチェックします。
	 * 
	 * また、リクエストを傍受された時のリプレイアタックの対策にもなります。
	 * 
	 * チェックエラー： OAUTH_BAD_NONCE を返します。
	 * 
	 * 
	 * @return OAUTH_OK
	 *         OAUTH_BAD_TIMESTAMP
	 *         OAUTH_BAD_NONCE
	 * 
	 * @see <a href="http://php.net/manual/ja/oauth.constants.php">PHP: 定義済み定数 - Manual</a>
	 */
	public function timestamp_nonce_callback()
	{
		/**
		 *  タイムスタンプチェック NG の場合
		 */
		//return OAUTH_BAD_TIMESTAMP;

		/**
		 *  タイムスタンプチェック NG の場合
		 */
		//return OAUTH_BAD_NONCE;

		return OAUTH_OK;
	}

	/**
	 * トークンのチェック
	 * 
	 * [トークン]
	 * User が Consumer に代理権を許可（認可）した時に
	 * Service Provider が Consumer に発行する識別子。
	 * Consumer が どの User の代理権を使用するのか識別する。
	 * トークンを使用するためには、さらにトークン所有者であることを
	 * 証明するトークンシークレットキー（共通鍵）が必要となる。
	 * 
	 * 
	 * [ベリファイア]
	 * リクエストトークンをアクセストークンと交換する認可証明情報。
	 * User が Consumer に対し代理権を許可（認可）する際に発行される。
	 * 
	 * @return OAUTH_OK
	 *         OAUTH_TOKEN_EXPIRED
	 *         OAUTH_TOKEN_REJECTED
	 *         OAUTH_VERIFIER_INVALID
	 */
	 public function check_token_callback()
	 {
		/**
		 *  トークン有効期限切れ の場合
		 */
		//return OAUTH_TOKEN_EXPIRED;

		/**
		 *  トークンチェック NG の場合
		 */
		//return OAUTH_TOKEN_REJECTED;

		/**
		 *  ベリファイアチェック NG の場合
		 */
		//return OAUTH_VERIFIER_INVALID;

		return OAUTH_OK;
	 } 


	/**
	 * コールバックの実行と 署名の検証
	 * 
	 * @return なし
	 * @throws OAuthException
	 */
	public function check_oauth_request()
	{
		$this->provider->checkOAuthRequest();
	}
}