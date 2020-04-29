<?php

namespace App\Admin\Controllers;

use App\Admin\Models\StationBannerImage;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use App\Admin\Models\Station;
use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;

class StationBannerImageController extends AdminController
{
   /**
    * Title for current resource.
    *
    * @var string
    */
   protected $title = '測站圖片';

   public function index(Content $content)
   {
      return $content
         ->header('測站圖片')
         ->description('管理')
         ->breadcrumb(['text' => '測站圖片管理'])
         ->body($this->grid());
   }
   /**
    * Make a grid builder.
    *
    * @return Grid
    */
   protected function grid()
   {
      $grid = new Grid(new StationBannerImage());

      $grid->column('id', __('Id'));
      $grid->column('station.station_name', __('測站'));
      $grid->column('image', __('輪播圖'))->image('', '50');
      $grid->column('url', __('連結'))->link();
      $grid->column('order', __('排序'));
      $grid->column('valid_at', __('有效日期'));
      $grid->column('mod_user', __('異動人員'));
      $grid->column('updated_at', __('異動時間'));

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
      $show = new Show(StationBannerImage::findOrFail($id));

      $show->field('id', __('Id'));
      $show->station_id('測站')->as(function ($station_id) {
         return Station::where('id', $station_id)->first()->station_name ?? null;
      });

      $show->field('image', __('輪播圖'))->image();
      $show->field('url', __('連結'))->link();
      $show->field('order', __('排序'));
      $show->field('valid_at', __('有效時期'));
      $show->field('mod_user', __('異動人員'));
      $show->field('created_at', __('建立時間'));
      $show->field('updated_at', __('異動時間'));

      return $show;
   }

   /**
    * Make a form builder.
    *
    * @return Form
    */
   protected function form()
   {
      $form = new Form(new StationBannerImage());

      $form->select('station_id', __('測站'))->options(Station::all()->pluck('station_name', 'id'))->rules('required');
      $form->image('image', __('輪播圖'))->help('圖片尺寸：2297*1583')->rules('required');
      $form->url('url', __('連結'))->placeholder('例：http://www.cwb.gov.tw');
      $form->text('order', __('排序'));
      $form->datetime('valid_at', __('有效日期'))->default(date('Y-m-d H:i:s'));
      $form->text('mod_user', __('異動人員'))->default(Admin::user()->name)->readonly();
      $form->saving(function (Form $form) {
         $form->mod_user = Admin::user()->name;
      });

      return $form;
   }
}
