<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gr馮ory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Sterud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //
//  Japanese translation by Mitsuhiro Yoshida<mits@mitstek.com>              //
//  http://mitstek.com/                                                      //
// ------------------------------------------------------------------------- //

$lang_charset = 'utf-8';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('バイト', 'KB', 'MB');

// Day of weeks and months
$lang_day_of_week = array('日', '月', '火', '水', '木', '金', '土');
$lang_month = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');

// Some common strings
$lang_yes = 'Yes';
$lang_no  = 'No';
$lang_back = '戻る';
$lang_continue = '続ける';
$lang_info = '情報';
$lang_error = 'エラー';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%Y年%B月%d日';
$lastcom_date_fmt =  '%y/%m/%d/ %H:%M';
$lastup_date_fmt =   '%Y年%B月%d日';
$register_date_fmt = '%Y年%B月%d日';
$lasthit_date_fmt =  '%Y年%B月%d日 %I:%M %p';
$comment_date_fmt =  '%Y年%B月%d日 %I:%M %p';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => 'ランダム写真',
	'lastup' => '新着写真',
	'lastcom' => '最新コメント',
	'topn' => '最多閲覧',
	'toprated' => 'トップレート',
	'lasthits' => '最終閲覧',
	'search' => '検索結果'
);

$lang_errors = array(
	'access_denied' => 'このページに対するアクセス権がありません。',
	'perm_denied' => 'この操作を行う権限がありません。',
	'param_missing' => '必要なパラメータ無しでスクリプトが実行されました。',
	'non_exist_ap' => '選択されたアルバム/写真が存在しません !',
	'quota_exceeded' => 'ディスク使用量オーバー<br /><br />あなたが使用できるディスク容量は [quota]Kです、現在 [space]Kを使用しています、この写真を追加することでディスク容量をオーバーします。',
	'gd_file_type_err' => 'GDイメージライブラリーを使用する場合、JPEGとPNG形式のファイルのみ利用可能です。',
	'invalid_image' => 'あなたがアップロードした画像は破損したか、GDライブラリーで処理することが出来ません。',
	'resize_failed' => '画像サイズが小さいため、サムネイルを作成出来ません。',
	'no_img_to_display' => '表示する画像はありません。',
	'non_exist_cat' => '選択したカテゴリーは存在しません。',
	'orphan_cat' => 'カテゴリーが存在しない親カテゴリーを持っています。カテゴリーマネージャーを使って問題を解決してください。',
	'directory_ro' => 'ディレクトリ \'%s\' に書込み権がありません。写真の削除は出来ません。',
	'non_exist_comment' => '選択したコメントは存在しません。',
	'pic_in_invalid_album' => '写真が存在しないアルバム(%s)内にあります !?'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'アルバムリストへ移動',
	'alb_list_lnk' => 'アルバムリスト',
	'my_gal_title' => 'パーソナルギャラリーへ移動',
	'my_gal_lnk' => 'マイギャラリー',
	'my_prof_lnk' => 'マイプロフィール',
	'adm_mode_title' => '管理者モードに変更',
	'adm_mode_lnk' => '管理者モード',
	'usr_mode_title' => 'ユーザモードに変更',
	'usr_mode_lnk' => 'ユーザモード',
	'upload_pic_title' => 'アルバムに写真をアップロード',
	'upload_pic_lnk' => '写真のアップロード',
	'register_title' => 'アカウントの作成',
	'register_lnk' => 'ユーザ登録',
	'login_lnk' => 'ログイン',
	'logout_lnk' => 'ログアウト',
	'lastup_lnk' => '最新アップロード',
	'lastcom_lnk' => '最新コメント',
	'topn_lnk' => '最多閲覧',
	'toprated_lnk' => 'トップレート',
	'search_lnk' => '検索',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'アップロード承認',
	'config_lnk' => '設定',
	'albums_lnk' => 'アルバム',
	'categories_lnk' => 'カテゴリ',
	'users_lnk' => 'ユーザ',
	'groups_lnk' => 'グループ',
	'comments_lnk' => 'コメント',
	'searchnew_lnk' => '写真の一括登録',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'マイアルバムの作成 / 整理',
	'modifyalb_lnk' => 'マイアルバムの修正',
	'my_prof_lnk' => 'マイプロフィール',
);

$lang_cat_list = array(
	'category' => 'カテゴリ',
	'albums' => 'アルバム',
	'pictures' => '写真',
);

$lang_album_list = array(
	'album_on_page' => 'アルバム数 %d / %dページ中'
);

$lang_thumb_view = array(
	'date' => '日付',
	'name' => '写真名',
	'sort_da' => '日付の昇順で並び替え',
	'sort_dd' => '日付の降順で並び替え',
	'sort_na' => '写真名の昇順で並び替え',
	'sort_nd' => '写真名の降順で並び替え',
	'pic_on_page' => '写真枚数 %d / %dページ中',
	'user_on_page' => 'ユーザ数 %d / %dページ中'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'サムネイルページに戻る',
	'pic_info_title' => '写真情報の表示/非表示',
	'slideshow_title' => 'スライドショー',
	'ecard_title' => 'この写真をe-カードとして送信する',
	'ecard_disabled' => 'e-カードは送信出来ません',
	'ecard_disabled_msg' => 'e-カードを送信する権限がありません。',
	'prev_title' => '前へ',
	'next_title' => '次へ',
	'pic_pos' => '写真 %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'この写真を評価する',
	'no_votes' => '(未投票)',
	'rating' => '(現在のレーティング: %s/5&nbsp;&nbsp;&nbsp;投票数 %s件)',
	'rubbish' => '酷い',
	'poor' => '悪い',
	'fair' => '普通',
	'good' => '良い',
	'excellent' => '素晴らしい',
	'great' => '凄い',
);

// ------------------------------------------------------------------------- //
// File include/exif.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/functions.inc.php
// ------------------------------------------------------------------------- //

$lang_cpg_die = array(
	INFORMATION => $lang_info,
	ERROR => $lang_error,
	CRITICAL_ERROR => '致命的なエラー',
	'file' => 'ファイル: ',
	'line' => '行: ',
);

$lang_display_thumbnails = array(
	'filename' => 'ファイル名 : ',
	'filesize' => 'ファイルサイズ : ',
	'dimensions' => '大きさ : ',
	'date_added' => '登録日 : '
);

$lang_get_pic_data = array(
	'n_comments' => 'コメント数 %s',
	'n_views' => '閲覧回数 %s',
	'n_votes' => '(投票数 %s)'
);

// ------------------------------------------------------------------------- //
// File include/init.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/picmgmt.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/smilies.inc.php
// ------------------------------------------------------------------------- //

if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array(
	'Exclamation' => 'ビックリ',
	'Question' => '質問',
	'Very Happy' => 'とても幸せ',
	'Smile' => 'スマイル',
	'Sad' => '悲しい',
	'Surprised' => '驚き',
	'Shocked' => 'ショック',
	'Confused' => '混乱',
	'Cool' => 'クール',
	'Laughing' => '笑い',
	'Mad' => '怒り',
	'Razz' => '苦笑い',
	'Embarassed' => '恥ずかしい',
	'Crying or Very sad' => '泣く又はとても悲しい',
	'Evil or Very Mad' => '悪い又はとても怒った',
	'Twisted Evil' => '意地悪い',
	'Rolling Eyes' => '転がる目',
	'Wink' => 'ウインク',
	'Idea' => 'アイディア',
	'Arrow' => '許可',
	'Neutral' => '中立',
	'Mr. Green' => 'ミスター・グリーン',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => '管理者モードを終了中 ...',
	1 => '管理者モードに移行中 ...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'アルバムにはアルバム名が必要です !',
	'confirm_modifs' => '本当に更新しても宜しいですか ?',
	'no_change' => '何も変更されていません !',
	'new_album' => '新しいアルバム',
	'confirm_delete1' => '本当にこのアルバムを削除しても宜しいですか ?',
	'confirm_delete2' => '\nアルバムに含まれる全ての写真とコメントは削除されます !',
	'select_first' => '最初にアルバムを選択してください。',
	'alb_mrg' => 'アルバム管理',
	'my_gallery' => '* マイギャラリー *',
	'no_category' => '* カテゴリ無し *',
	'delete' => '削除',
	'new' => '新規作成',
	'apply_modifs' => '更新の適用',
	'select_category' => 'カテゴリ選択',
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => '「%s」の操作に必要なパラメータが渡されていません !',
	'unknown_cat' => '選択したカテゴリはデータベースに存在しません。',
	'usergal_cat_ro' => 'ユーザギャラリーのカテゴリーは削除出来ません !',
	'manage_cat' => 'カテゴリの管理',
	'confirm_delete' => '本当にこのカテゴリを削除しても宜しいですか ?',
	'category' => 'カテゴリ',
	'operations' => '操作',
	'move_into' => '移動先',
	'update_create' => 'カテゴリの作成/更新',
	'parent_cat' => '親カテゴリ',
	'cat_title' => 'カテゴリ名',
	'cat_desc' => 'カテゴリ説明'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => '設定',
	'restore_cfg' => 'インストール直後の状態に戻す',
	'save_cfg' => '新しい設定を保存する',
	'notes' => 'Notes',
	'info' => '情報',
	'upd_success' => 'Coppermineの設定が更新されました。',
	'restore_success' => 'Coppermineデフォルトの設定にリストアされました。',
	'name_a' => '写真名の昇順',
	'name_d' => '写真名の降順',
	'date_a' => '日付の昇順',
	'date_d' => '日付の降順'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'一般設定',
	array('ギャラリー名', 'gallery_name', 0),
	array('ギャラリーの説明', 'gallery_description', 0),
	array('管理者のメールアドレス', 'gallery_admin_email', 0),
	array('e-カードの「もっと写真を見る」リンクのターゲットアドレス', 'ecards_more_pic_target', 0),
	array('言語', 'lang', 5),
	array('テーマ', 'theme', 6),

	'アルバムリスト表示',
	array('メインテーブルの幅 (ピクセル又は%)', 'main_table_width', 0),
	array('カテゴリ階層の表示数', 'subcat_level', 0),
	array('アルバムの表示数', 'albums_per_page', 0),
	array('アルバムリストの列数', 'album_list_cols', 0),
	array('サムネイルのサイズ (ピクセル)', 'alb_list_thumb_size', 0),
	array('メインページのコンテンツ', 'main_page_layout', 0),

	'サムネイル表示',
	array('サムネイルページの列数', 'thumbcols', 0),
	array('サムネイルページの行数', 'thumbrows', 0),
	array('タブの最大表示数', 'max_tabs', 0),
	array('サムネイルの下に写真説明を表示する (写真名に追加)', 'caption_in_thumbview', 1),
	array('サムネイルの下に表示するコメント数', 'display_comment_count', 1),
	array('写真表示順のデフォルト', 'default_sort_order', 3),
	array('「トップレート」リストに表示される写真の最低投票数', 'min_votes_for_rating', 0),

	'画像閲覧とコメント設定',
	array('写真表示のテーブル幅 (ピクセル又は%)', 'picture_table_width', 0),
	array('写真情報をデフォルトで表示する', 'display_pic_info', 1),
	array('コメント中の悪い言葉を取除く', 'filter_bad_words', 1),
	array('コメントのスマイリー使用を許可する', 'enable_smilies', 1),
	array('写真説明の最大長', 'max_img_desc_length', 0),
	array('1語あたりの最大文字数 (注意: 日本語の場合、コメントの最大長と同値)', 'max_com_wlength', 0),
	array('コメントの最大行数', 'max_com_lines', 0),
	array('コメントの最大長 (半角換算)', 'max_com_size', 0),

	'写真とサムネイル設定',
	array('JPEGファイルのクオリティー', 'jpeg_qual', 0),
	array('サムネイルの最大幅又は高さ <b>*</b>', 'thumb_width', 0),
	array('中間写真を作成する','make_intermediate',1),
	array('中間写真の最大幅又は高さ <b>*</b>', 'picture_width', 0),
	array('アップロード写真の最大サイズ (KB)', 'max_upl_size', 0),
	array('アップロード写真の最大幅又は高さ (ピクセル)', 'max_upl_width_height', 0),

	'ユーザ設定',
	array('ユーザ登録を許可する', 'allow_user_registration', 1),
	array('ユーザ登録にメール承認を必要とする', 'reg_requires_valid_email', 1),
	array('2人のユーザによる同一メールアドレスの登録を許可する', 'allow_duplicate_emails_addr', 1),
	array('ユーザがプライベートアルバムを作成出来る', 'allow_private_albums', 1),

	'画像説明のためのカスタムフィールド (使用しない場合は空白)',
	array('フィールド名 1', 'user_field1_name', 0),
	array('フィールド名 2', 'user_field2_name', 0),
	array('フィールド名 3', 'user_field3_name', 0),
	array('フィールド名 4', 'user_field4_name', 0),

	'写真とサムネイルの高度な設定',
	array('ファイル名の使用禁止文字', 'forbiden_fname_char',0),
	array('写真のアップロードで使用出来るファイルの拡張子', 'allowed_file_extensions',0),
	array('イメージリサイズの方法','thumb_method',2),
	array('ImageMagick convertユーティリティーのパス (例 /usr/bin/X11/)', 'impath', 0),
	array('使用できる画像タイプ (ImageMagickのみに有効)', 'allowed_img_types',0),
	array('ImageMagickのコマンドラインオプション', 'im_options', 0),
	array('JPEGファイルのEXIFデータを読み取る', 'read_exif_data', 1),
	array('アルバムディレクトリ <b>*</b>', 'fullpath', 0),
	array('ユーザ写真のディレクトリ <b>*</b>', 'userpics', 0),
	array('中間写真の接頭辞 <b>*</b>', 'normal_pfx', 0),
	array('サムネイルの接頭辞 <b>*</b>', 'thumb_pfx', 0),
	array('ディレクトリのデフォルト・パーミッションモードモード', 'default_dir_mode', 0),
	array('写真のデフォルト・パーミッションモード', 'default_file_mode', 0),

	'クッキーとキャラクターセット設定',
	array('スクリプトで使用するクッキー名', 'cookie_name', 0),
	array('スクリプトで使用するクッキーの保存先', 'cookie_path', 0),
	array('エンコード', 'charset', 4),

	'その他の設定',
	array('デバッグモードを使用する', 'debug_mode', 1),

	'<br /><div align="center">(*) 既にギャラリーに写真が登録されている場合、*マークが付いているフィールドは変更しないでください</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'お名前とコメントを入力してください。',
	'com_added' => 'あなたのコメントは追加されました。',
	'alb_need_title' => 'アルバム名を入力してください !',
	'no_udp_needed' => '更新は必要ありません。',
	'alb_updated' => 'アルバムが更新されました。',
	'unknown_album' => '選択したアルバムが存在しない、又はこのアルバムにアップロードする権限がありません。',
	'no_pic_uploaded' => '写真はアップロードされませんでした !<br /><br />アップロードする写真を正しく選択した場合、サーバが</br>ファイルのアップロードを許可しているか確認してください ...',
	'err_mkdir' => 'ディレクトリ %s の作成に失敗しました !',
	'dest_dir_ro' => '対象ディレクトリ %s はスクリプトによる書込みが出来ません !',
	'err_move' => '%s を %s に移動できません !',
	'err_fsize_too_large' => 'あなたがアップロードした写真のサイズは大き過ぎます (最大サイズは%sx%sです) !',
	'err_imgsize_too_large' => 'あなたがアップロードしたファイルのサイズは大き過ぎます (最大サイズは%sKBです) !',
	'err_invalid_img' => 'あなたがアップロードしたファイルは有効な画像ではありません !',
	'allowed_img_types' => '%s の画像のみアップロード出来ます。',
	'err_insert_pic' => '写真「%s」はアルバムに登録できません。 ',
	'upload_success' => 'あなたの写真は正常にアップロードされました<br /><br />管理者の承認後に表示されます。',
	'info' => '情報',
	'com_added' => 'コメントが追加されました。',
	'alb_updated' => 'アルバムが更新されました。',
	'err_comment_empty' => 'コメントが空白です !',
	'err_invalid_fext' => '次の拡張子のファイルのみ使用できます: <br /><br />%s.',
	'no_flood' => '申し訳ございません、あなたは既にこの写真に最新コメントを投稿しています<br /><br />修正したい場合は、コメントを編集してください。',
	'redirect_msg' => 'リダイレクトされました。<br /><br /><br />ページが自動的に更新されない場合は、「続く」をクリックしてください。',
	'upl_success' => 'あなたの写真は正常に登録されました。',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'Caption',
	'fs_pic' => 'フルサイズ画像',
	'del_success' => '削除成功',
	'ns_pic' => 'ノーマルサイズ画像',
	'err_del' => '削除不可',
	'thumb_pic' => 'サムネイル',
	'comment' => 'コメント',
	'im_in_alb' => 'アルバム内の画像',
	'alb_del_success' => 'アルバム「%s」が削除されました。',
	'alb_mgr' => 'アルバムマネージャー',
	'err_invalid_data' => '「%s」に不正なデータが発生しました。',
	'create_alb' => 'アルバム「%s」の作成中',
	'update_alb' => 'アルバム「%s」 アルバム名「%s」 インデックス「%s\」を更新しています。',
	'del_pic' => '写真の削除',
	'del_alb' => 'アルバムの削除',
	'del_user' => 'ユーザの削除',
	'err_unknown_user' => '選択したユーザは存在しません !',
	'comment_deleted' => 'コメントが削除されました。',
);

// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //

if (defined('DISPLAYIMAGE_PHP')){

$lang_display_image_php = array(
	'confirm_del' => '本当にこの写真を削除しても宜しいですか ? \\n同時にコメントも削除されます。',
	'del_pic' => 'この写真を削除する',
	'size' => '%s x %s ピクセル',
	'views' => '%s 回',
	'slideshow' => 'スライドショー',
	'stop_slideshow' => 'スライドショーを停止',
	'view_fs' => 'クリックでフルサイズの画像を表示',
);

$lang_picinfo = array(
	'title' =>'写真情報',
	'Filename' => 'ファイル名',
	'Album name' => 'アルバム名',
	'Rating' => 'レーティング (投票数 %s件)',
	'Keywords' => 'キーワード',
	'File Size' => 'ファイルサイズ',
	'Dimensions' => '大きさ',
	'Displayed' => '表示',
	'Camera' => 'カメラ',
	'Date taken' => '撮影日',
	'Aperture' => 'レンズ',
	'Exposure time' => '露出時間',
	'Focal length' => '焦点距離',
	'Comment' => 'コメント'
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'このコメントを編集する',
	'confirm_delete' => '本当にこのコメントを削除しても宜しいですか ?',
	'add_your_comment' => 'コメントを追加する',
	'your_name' => 'お名前',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'e-カードの送信',
	'invalid_email' => '<b>警告</b> : メールアドレスが正しくありません !',
	'ecard_title' => 'An e-card from %s for you',
	'view_ecard' => 'e-カードが正常に表示されない場合は、このリンクをクリックしてください。',
	'view_more_pics' => 'もっと写真を見る場合は、このリンクをクリックしてください !',
	'send_success' => 'e-カードが送信されました。',
	'send_failed' => '申し訳ございません、e-cardを送信出来ませんでした ...',
	'from' => 'From',
	'your_name' => 'お名前',
	'your_email' => 'メールアドレス',
	'to' => 'To',
	'rcpt_name' => '受取人のお名前',
	'rcpt_email' => '受取人のメールアドレス',
	'greetings' => 'あいさつ',
	'message' => 'メッセージ',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => '写真情報',
	'album' => 'アルバム',
	'title' => '写真名',
	'desc' => '説明',
	'keywords' => 'キーワード',
	'pic_info_str' => '%sx%s - %sKB - 閲覧回数 %s - 投票数 %s',
	'approve' => '写真の承認',
	'postpone_app' => '承認の延期',
	'del_pic' => '写真の削除',
	'reset_view_count' => '閲覧カウンタのリセット',
	'reset_votes' => '投票のリセット',
	'del_comm' => 'コメントの削除',
	'upl_approval' => 'アップロード承認',
	'edit_pics' => '写真の編集',
	'see_next' => '前へ',
	'see_prev' => '次へ',
	'n_pic' => '写真枚数 %s',
	'n_of_pic_to_disp' => '写真表示数',
	'apply' => '更新の適用'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'グループ名',
	'disk_quota' => 'ディスク容量',
	'can_rate' => '写真を評価可能',
	'can_send_ecards' => 'e-カードを送信可能',
	'can_post_com' => 'コメントを投稿可能',
	'can_upload' => '写真をアップロード可能',
	'can_have_gallery' => 'パーソナルギャラリーを作成可能',
	'apply' => '更新の適用',
	'create_new_group' => '新規グループの作成',
	'del_groups' => '選択したグループの削除',
	'confirm_del' => '警告、グループを削除した場合、グループに属していたユーザは\'Registered\'グループに移動されます !\n\n処理を続けますか ?',
	'title' => 'ユーザグループの管理',
	'approval_1' => 'パブリックアップロード承認 (1)',
	'approval_2' => 'プライベートアップロード承認 (2)',
	'note1' => '<b>(1)</b> パブリックアルバムへアップロードされた写真は管理者の承認が必要です。',
	'note2' => '<b>(2)</b> ユーザのアルバムへアップロードされた写真は管理者の承認が必要です。',
	'notes' => '注意'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'ようこそ !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => '本当にこのアルバムを削除しても宜しいですか ? \\n同時に全ての写真とコメントは削除されます。',
	'delete' => '削除',
	'modify' => 'プロパティ',
	'edit_pics' => '写真の編集',
);

$lang_list_categories = array(
	'home' => 'Home',
	'stat1' => 'カテゴリ数:<b>[cat]</b>&nbsp;&nbsp;&nbsp;アルバム数:<b>[albums]</b>&nbsp;&nbsp;&nbsp;写真枚数:<b>[pictures]</b>&nbsp;&nbsp;&nbsp;コメント数:<b>[comments]</b>&nbsp;&nbsp;&nbsp;閲覧回数:<b>[views]</b>',
	'stat2' => 'アルバム数:<b>[albums]</b>&nbsp;&nbsp;&nbsp;写真枚数:<b>[pictures]</b>&nbsp;&nbsp;&nbsp;閲覧回数:<b>[views]</b>',
	'xx_s_gallery' => '%sのギャラリー',
	'stat3' => 'アルバム数:<b>[albums]</b>&nbsp;&nbsp;&nbsp;写真枚数:<b>[pictures]</b>&nbsp;&nbsp;&nbsp;コメント数:<b>[comments]</b>&nbsp;&nbsp;&nbsp;閲覧回数:<b>[views]</b>'
);

$lang_list_users = array(
	'user_list' => 'ユーザリスト',
	'no_user_gal' => 'ユーザギャラリーはありません。',
	'n_albums' => 'アルバム数 %s',
	'n_pics' => '写真枚数 %s'
);

$lang_list_albums = array(
	'n_pictures' => '写真枚数 %s',
	'last_added' => '、最終追加日:%s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'ログイン',
	'enter_login_pswd' => 'ユーザ名とパスワードを入力してください。',
	'username' => 'ユーザ名',
	'password' => 'パスワード',
	'remember_me' => 'ユーザ名・パスワードを保存',
	'welcome' => 'ようこそ %sさん...',
	'err_login' => '*** ログイン出来ませんでした。再度ログインしてください ***',
	'err_already_logged_in' => '既にログインしています !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'ログアウト',
	'bye' => '%sさん、さようなら...',
	'err_not_loged_in' => 'ログインしていません !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'アルバムの更新 %s',
	'general_settings' => '一般設定',
	'alb_title' => 'アルバム名',
	'alb_cat' => 'カテゴリ',
	'alb_desc' => '説明',
	'alb_thumb' => 'サムネイル',
	'alb_perm' => 'このアルバムに対するパーミッション',
	'can_view' => 'アルバム閲覧可能',
	'can_upload' => 'ビジターは写真をアップロード出来る',
	'can_post_comments' => 'ビジターはコメントを投稿できる',
	'can_rate' => 'ビジターは写真を評価出来る',
	'user_gal' => 'ユーザギャラリー',
	'no_cat' => '* カテゴリー無し *',
	'alb_empty' => 'アルバムには何も入っていません',
	'last_uploaded' => '最新アップロード',
	'public_alb' => '全員 (パブリックアルバム)',
	'me_only' => '私のみ',
	'owner_only' => 'アルバムの所有者 (%s) のみ',
	'groupp_only' => '%sグループメンバーのみ',
	'err_no_alb_to_modify' => '修正できるアルバムがデータベースにありません。',
	'update' => 'アルバムの更新'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => '申し訳ございません、あなたは既にこの写真を評価しています。',
	'rate_ok' => 'あなたの投票は受理されました。',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
{SITE_NAME}の管理者は、一般的に好ましくない投稿を出来るだけ速やかに削除するよう試みますが、全ての投稿を閲覧することは不可能です。従って、このサイトに対する全投稿の見解が投稿者によるものであり、管理者やウェブマスターのもので無く(これらの人々の投稿は除く)、管理者やウェブマスターに投稿の責任が無いことをあなたは認めます。
<br>
<br>
あなたは、公序良俗に反する投稿や、個人への誹謗中傷の投稿、性的な投稿、その他法に反する投稿をしない事に同意します。
あなたは、{SITE_NAME}の管理者、ウェブマスター、モデレーターが如何なる時も投稿内容を編集・削除する権利を有することに同意します。あなたは、ユーザとしてあなたが投稿した情報がデータベースに保存されることに同意します。この情報は、あなたの同意無しに管理者、ウェブマスターより第三者に開示されることはありませんが、データが流出する恐れのあるハッキング等の行為に対して管理者、ウェブマスターは責任を負うことはありません。
<br>
<br>
このサイトでは、あなたのコンピュータに情報を保存するためにクッキーを使用します。クッキーはあなたの閲覧を快適にする為だけに使用されます。メールアドレスは、あなたの登録に関する詳細及びパスワードの認証の為だけに使用されます。 
<br>
<br>
「同意します」をクリックすることで、あなたは上記の利用規約に同意します。
EOT;
$lang_register_php = array(
	'page_title' => 'ユーザ登録',
	'term_cond' => '利用規約',
	'i_agree' => '同意します',
	'submit' => '登録実行',
	'err_user_exists' => '入力されたユーザ名は既に登録されています、別のユーザ名を入力してください。',
	'err_password_mismatch' => 'パスワードが一致しません、再度入力してください。',
	'err_uname_short' => 'ユーザ名は2文字以上にしてください。',
	'err_password_short' => 'パスワードは2文字以上にしてください。',
	'err_uname_pass_diff' => 'ユーザ名とパスワードは異なる必要があります。',
	'err_invalid_email' => 'メールアドレスが正しくありません。',
	'err_duplicate_email' => '他のユーザが既に同じメールアドレスを登録しています。',
	'enter_info' => '登録情報を入力してください。',
	'required_info' => '必須項目',
	'optional_info' => '任意項目',
	'username' => 'ユーザ名',
	'password' => 'パスワード',
	'password_again' => 'パスワードをもう一度',
	'email' => 'メールアドレス',
	'location' => '居住地',
	'interests' => '興味のあること',
	'website' => 'ホームページ',
	'occupation' => '職業',
	'error' => 'エラー',
	'confirm_email_subject' => '%s - Registration confirmation',
	'information' => '情報',
	'failed_sending_email' => '登録確認メールが送信できません !',
	'thank_you' => 'ご登録ありがとうございます。<br /><br />アカウントの活性化に関する情報が登録されたメールアドレス宛に送信されました。',
	'acct_created' => 'あなたのアカウントが作成されました。ユーザ名とパスワードでログイン出来ます。',
	'acct_active' => 'あなたのアカウントが活性化されました。ユーザ名とパスワードでログイン出来ます。',
	'acct_already_act' => 'あなたのアカウントは既に活性化されています !',
	'acct_act_failed' => 'このアカウントは活性化出来ません !',
	'err_unk_user' => '選択したユーザは存在しません !',
	'x_s_profile' => '%s のプロフィール',
	'group' => 'グループ',
	'reg_date' => '登録年月日',
	'disk_usage' => 'ディスク使用量',
	'change_pass' => 'パスワードの変更',
	'current_pass' => '現在のパスワード',
	'new_pass' => '新しいパスワード',
	'new_pass_again' => '新しいパスワードをもう一度',
	'err_curr_pass' => '現在のパスワードが正しくありません。',
	'apply_modif' => '更新の適用',
	'change_pass' => 'パスワードの変更',
	'update_success' => 'プロフィールが更新されました。',
	'pass_chg_success' => 'パスワードが変更されました。',
	'pass_chg_error' => 'パスワードが変更されませんでした。',
);

$lang_register_confirm_email = <<<EOT
{SITE_NAME} へのご登録ありがとうございます。

あなたのユーザ名は "{USER_NAME}" です。
あなたのパスワードは "{PASSWORD}" です。

アカウントの活性化をするには下記のリンクをクリック又は
ブラウザのアドレス欄にコピーしてください。

{ACT_LINK}管理者


{SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'コメントのレビュー',
	'no_comment' => 'レビューするコメントはありません。',
	'n_comm_del' => '%s件のコメントが削除されました。',
	'n_comm_disp' => '表示するコメント数',
	'see_prev' => '前へ',
	'see_next' => '次へ',
	'del_comm' => '選択したコメントを削除',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => '写真の検索',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => '新しい写真の検索',
	'select_dir' => 'ディレクトリ選択',
	'select_dir_msg' => 'ここではFTPによりサーバにアップロードした写真をアルバムに一括登録します<br /><br />写真をアップロードしたディレクトリを選択してください。',
	'no_pic_to_add' => '追加する写真はありません。',
	'need_one_album' => 'この機能を使うためには1つ以上のアルバムが必要です。',
	'warning' => '警告',
	'change_perm' => 'スクリプトがこのディレクトリに書込めませんでした、写真を追加する前にディレクトリのパーミッションモードを755又は777に変更する必要があります !',
	'target_album' => '<b>「</b>%s<b>」内の写真を</b>%s<b>に追加する</b>',
	'folder' => 'フォルダ',
	'image' => '画像',
	'album' => 'アルバム',
	'result' => '結果',
	'dir_ro' => '書込み権がありません。',
	'dir_cant_read' => '読取り権がありません。',
	'insert' => '新規写真のギャラリーへの追加',
	'list_new_pic' => '新規写真一覧',
	'insert_selected' => '選択した写真の追加',
	'no_pic_found' => '新しい写真は見つかりませんでした。',
	'be_patient' => '暫くお待ちください、スクリプトが写真を追加するには時間が必要です。',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : 正常に写真が追加されました。'.
				'<li><b>DP</b> : 写真が重複して既にデータベースに登録されています。'.
				'<li><b>PB</b> : 写真を追加出来ませんでした、設定及び写真が登録されるディレクトリのパーミッションを確認してください。'.
				'<li>OK、DP、PBサインのいずれも表示されなかった場合は、PHPエラーを表示するために破損した写真をクリックしてください。'.
				'<li>タイムアウトが発生した場合、ブラウザの更新ボタンをクリックしてください。'.
				'</ul>',
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void


// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => '写真のアップロード',
	'max_fsize' => 'アップロード可能な最大ファイルサイズは%sKBです。',
	'album' => 'アルバム',
	'picture' => '写真',
	'pic_title' => '写真名',
	'description' => '写真の説明',
	'keywords' => 'キーワード (半角スペースで区切る)',
	'err_no_alb_uploadables' => '写真のアップロードが許可されたアルバムはありません。',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'ユーザの管理',
	'name_a' => 'ユーザ名の昇順',
	'name_d' => 'ユーザ名の降順',
	'group_a' => 'グループ名の昇順',
	'group_d' => 'グループ名の降順',
	'reg_a' => '登録日の昇順',
	'reg_d' => '登録日の降順',
	'pic_a' => '写真枚数の昇順',
	'pic_d' => '写真枚数の降順',
	'disku_a' => 'ディスク使用量の昇順',
	'disku_d' => 'ディスク使用量の降順',
	'sort_by' => 'ユーザの並び替え',
	'err_no_users' => 'ユーザテーブルが空です !',
	'err_edit_self' => '自分自身のプロフィールは編集できません。「マイプロフィール」を使用してください。',
	'edit' => '編集',
	'delete' => '削除',
	'name' => 'ユーザ名',
	'group' => 'グループ',
	'inactive' => '非活性',
	'operations' => '操作',
	'pictures' => '写真',
	'disk_space' => '使用済み容量 / 容量',
	'registered_on' => '登録年月日',
	'u_user_on_p_pages' => 'ユーザ数 %d / %dページ中',
	'confirm_del' => '本当にこのユーザを削除しても宜しいですか ? \\ユーザに属する全ての写真とアルバムは削除されます。',
	'mail' => 'メール',
	'err_unknown_user' => '選択したユーザは存在しません !',
	'modify_user' => 'ユーザの変更',
	'notes' => '注意',
	'note_list' => '<li>現在のパスワードを変更したくない場合は、「パスワード」フィールドを空白にしてください。',
	'password' => 'パスワード',
	'user_active' => 'ユーザを活性化する',
	'user_group' => 'グループ',
	'user_email' => 'メールアドレス',
	'user_web_site' => 'ホームページ',
	'create_new_user' => '新規ユーザの作成',
	'user_location' => '居住地',
	'user_interests' => '興味のあること',
	'user_occupation' => '職業',
);
?>