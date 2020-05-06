<?php

namespace App\Admin\Controllers;

use App\Admin\Models\SceneImage;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use App\Admin\Models\Station;
use App\Admin\Models\Scenery;
use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;

class SceneImageController extends AdminController
{
   /**
    * Title for current resource.
    *
    * @var string
    */
   protected $title = '周邊景點圖片';

   public function index(Content $content)
   {
      return $content
         ->header('周邊景點圖片')
         ->description('管理')
         ->breadcrumb(['text' => '周邊景點圖片管理'])
         ->body($this->grid());
   }

   /**
    * Make a grid builder.
    *
    * @return Grid
    */
   protected function grid()
   {
      $grid = new Grid(new SceneImage());
      $station_id = Admin::user()->station_id;
      $username = Admin::user()->username;

      $grid->column('station.station_name', __('測站名稱'));
      //$grid->column('station_code');
      $grid->column('scn_id', __('景點編號'));
      $grid->column('image', __('圖片'))->image('', '50');
      $grid->column('order', __('排序'));
      $grid->column('valid_at', __('有效日期'));
      $grid->column('mod_user', __('異動人員'));
      $grid->column('updated_at', __('異動時間'));

      if ($username != 'admin') {
         $grid->model()->where('station_id', '=', $station_id);
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
      $show = new Show(SceneImage::findOrFail($id));

      $show->field('id', __('Id'));

      $show->field('station_id', __('測站名稱'))->as(function ($station_id) {
         return Station::where('id', $station_id)->first()->station_name ?? null;
      });

      $show->field('image', __('景點圖'))->image();
      $show->field('order', __('排序'));
      $show->field('valid_at', __('有效日期'));
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
      $form = new Form(new SceneImage());
      $station_id = Admin::user()->station_id;

      $form->select('station_id', __('測站名稱'))->options(Station::all()->pluck('station_name', 'id'))->default($station_id)->readonly();
      //$form->select('station_code', __('測站名稱'))->options(Station::where('id', $station_code)->pluck('station_name', 'id'));
      //$form->text('station_code', __('測站代號'))->default(Admin::user()->station_id)->readonly();
      $form->select('scn_id', __('景點編號'))->options(Scenery::where('station_id', $station_id)->pluck('scn_id', 'scn_id'))->rules('required');
      $form->image('image', __('景點圖'))->help('圖片尺寸：2297*1583')->rules('required');
      $form->text('order', __('排序'));
      $form->datetime('valid_at', __('有效日期'))->default(date('Y-m-d H:i:s'));
      $form->text('mod_user', __('異動人員'))->default(Admin::user()->name)->readonly();
      $form->saving(function (Form $form) {
         $form->mod_user = Admin::user()->name;
      });

      return $form;
   }
}
