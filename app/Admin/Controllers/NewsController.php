<?php

namespace App\Admin\Controllers;

use App\Admin\Models\News;
use App\Admin\Models\Station;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;

class NewsController extends AdminController
{
   /**
    * Title for current resource.
    *
    * @var string
    */
   protected $title = '最新消息管理';

   public function index(Content $content)
   {
      return $content
         ->header(trans('admin.news.news'))
         ->description(trans('admin.management'))
         ->breadcrumb(['text' => trans('admin.news.news') . trans('admin.management')])
         ->body($this->grid());
   }
   /**
    * Make a grid builder.
    *
    * @return Grid
    */
   protected function grid()
   {
      $grid = new Grid(new News());

      $grid->column('id', trans('ID'));
      $grid->column('station.station_name', trans('admin.news.station_name'));
      $grid->column('news_type', trans('admin.news.news_type'))->display(function ($news_type) {
         $newsTypes = [
            0 => trans('admin.news.newsType.announcement'),
            1 => trans('admin.news.newsType.activity'),
         ];
         return $newsTypes[$news_type] ?? null;
      });
      $grid->column('news_title', trans('admin.news.news_title'));
      $grid->column('order', trans('admin.news.order'));
      $grid->column('valid_at', trans('admin.news.valid_at'));
      $grid->column('mod_user', trans('admin.news.mod_user'));
      $grid->column('updated_at', trans('admin.news.updated_at'));

      if (Admin::user()->username != 'admin') {
         $grid->model()->where('station_id', '=', Admin::user()->station_id);
      }

      return $grid;
   }

   /**
    * Make a show builder.
    *
    * @param mixed $id
    * @return Show
    */
   protected function detail($id)
   {
      $show = new Show(News::findOrFail($id));

      $show->field('id', __('ID'));
      $show->station_id(trans('admin.news.station_name'))->as(function ($station_id) {
         return Station::where('id', $station_id)->first()->station_name ?? null;
      });

      $show->field('news_type', trans('admin.news.news_type'))->as(function ($news_type) {
         $newsTypes = [
            0 => trans('admin.news.newsType.announcement'),
            1 => trans('admin.news.newsType.activity'),
         ];
         return $newsTypes[$news_type] ?? null;
      });

      $show->field('news_title', trans('admin.news.news_title'));
      $show->field('news_excerpt', trans('admin.news.news_excerpt'));
      $show->field('news_content', trans('admin.news.news_content'))->unescape();
      $show->field('news_date', trans('admin.news.news_date'));
      $show->field('news_location', trans('admin.news.news_location'));
      $show->field('news_dept', trans('admin.news.news_dept'));
      $show->field('news_cate', trans('admin.news.news_cate'));
      $show->field('news_remark', trans('admin.news.news_remark'));
      $show->field('news_image', trans('admin.news.news_image'))->image();
      $show->field('on_main_page', trans('admin.news.on_main_page'));
      $show->field('on_index', trans('admin.news.on_index'));
      $show->field('order', trans('admin.news.order'));
      $show->field('valid_at', trans('admin.news.valid_at'));
      $show->field('mod_user', trans('admin.news.mod_user'));
      $show->field('created_at', trans('admin.news.created_at'));
      $show->field('updated_at', trans('admin.news.updated_at'));

      return $show;
   }

   /**
    * Make a form builder.
    *
    * @return Form
    */
   protected function form()
   {
      $form = new Form(new News());

      $newsTypes = [
         0 => trans('admin.news.newsType.announcement'),
         1 => trans('admin.news.newsType.activity'),
      ];

      $form->select('station_id', trans('admin.news.station_id'))->options(Station::all()->pluck('station_name', 'id'))->rules('required');
      $form->select('news_type', trans('admin.news.news_type'))->options($newsTypes)->rules('required');
      $form->text('news_title', trans('admin.news.news_title'))->rules('required');
      $form->textarea('news_excerpt', trans('admin.news.news_excerpt'));
      $form->ckeditor('news_content', trans('admin.news.news_content'));
      $form->text('news_date', trans('admin.news.news_date'));
      $form->text('news_location', trans('admin.news.news_location'));
      $form->text('news_dept', trans('admin.news.news_dept'));
      $form->text('news_cate', trans('admin.news.news_cate'));
      $form->textarea('news_remark', trans('admin.news.news_remark'));
      // $form->text('news_image', trans('admin.news.news_image'));
      $form->image('news_image', trans('admin.news.news_image'))->move('images/news')->name(function ($file) {
         $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
         $guessExtension = $file->guessExtension();
         return date('YmdHis') . '_' . $fileName . '.' . $guessExtension;
      });
      $form->switch('on_main_page', trans('admin.news.on_main_page'));
      $form->switch('on_index', trans('admin.news.on_index'));
      $form->number('order', trans('admin.news.order'));
      $form->datetime('valid_at', trans('admin.news.valid_at'))->default(date('Y-m-d H:i:s'));
      $form->text('mod_user', trans('admin.news.mod_user'))->default(Admin::user()->name)->readonly();
      $form->saving(function (Form $form) {
         $form->mod_user = Admin::user()->name;
      });

      return $form;
   }
}
