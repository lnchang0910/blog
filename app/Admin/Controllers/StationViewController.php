<?php

namespace App\Admin\Controllers;

use App\Admin\Models\StationView;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use App\Admin\Models\Station;
use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;

class StationViewController extends AdminController
{
   /**
    * Title for current resource.
    *
    * @var string
    */
   protected $title = '測站特色';

   public function index(Content $content)
   {
      return $content
         ->header('測站特色')
         ->description('管理')
         ->breadcrumb(['text' => '測站特色管理'])
         ->body($this->grid());
   }

   /**
    * Make a grid builder.
    *
    * @return Grid
    */
   protected function grid()
   {
      $grid = new Grid(new StationView());

      $grid->column('id', __('Id'));
      $grid->column('station.station_name', __('測站'));
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
      $show = new Show(StationView::findOrFail($id));

      $show->field('id', __('Id'));
      $show->station_id('測站')->as(function ($station_id) {
         return Station::where('id', $station_id)->first()->station_name ?? null;
      });
      $show->field('description', __('測站特色描述'))->unescape();
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
      $form = new Form(new StationView());

      $form->select('station_id', __('測站'))->options(Station::all()->pluck('station_name', 'id'))->rules('required');
      $form->ckeditor('description', __('測站特色描述'))->rules('required');
      $form->text('mod_user', __('異動人員'))->default(Admin::user()->name)->readonly();
      $form->saving(function (Form $form) {
         $form->mod_user = Admin::user()->name;
      });

      return $form;
   }
}
