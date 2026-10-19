<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CrudProfileController;
use App\Http\Controllers\api\General\AbsenController;
use App\Http\Controllers\api\General\DailyController;
use App\Http\Controllers\api\General\GeneralController;
use App\Http\Controllers\api\OtpController;
use App\Http\Controllers\api\Specific\BasicInformationController;
use App\Http\Controllers\api\Specific\BookingController;
use App\Http\Controllers\api\Specific\ConsumptionController;
use App\Http\Controllers\api\Specific\DeliveryController;
use App\Http\Controllers\api\Specific\DietController;
use App\Http\Controllers\api\Specific\HealthCheckController;
use App\Http\Controllers\api\Specific\IncidentController;
use App\Http\Controllers\api\Specific\LogisticController;
use App\Http\Controllers\api\Specific\MamalReportController;
use App\Http\Controllers\api\Specific\NotificationController;
use App\Http\Controllers\api\Specific\OrderController;
use App\Http\Controllers\api\Specific\PoolAreaController;
use App\Http\Controllers\api\Specific\SalesController;
use App\Http\Controllers\api\Specific\ScheduleController;
use App\Http\Controllers\api\Specific\SecuirtyDailyController;
use App\Http\Controllers\api\Specific\SecurityVisitorController;
use App\Http\Controllers\api\Specific\WaterQualityController;
use App\Http\Controllers\api\Specific\WorkorderController;
use App\Http\Controllers\api\SuperAdmin\AccessAPIController;
use App\Http\Controllers\api\SuperAdmin\AccessWebController;
use App\Http\Controllers\api\SuperAdmin\ApiController;
use App\Http\Controllers\api\SuperAdmin\AreaController;
use App\Http\Controllers\api\SuperAdmin\ContractController;
use App\Http\Controllers\api\SuperAdmin\DivisionController;
use App\Http\Controllers\api\SuperAdmin\FullTimeController;
use App\Http\Controllers\api\SuperAdmin\MamalController;
use App\Http\Controllers\api\SuperAdmin\Master\AttachController;
use App\Http\Controllers\api\SuperAdmin\MethodeBookingController;
use App\Http\Controllers\api\SuperAdmin\PoolController;
use App\Http\Controllers\api\SuperAdmin\PositionController;
use App\Http\Controllers\api\SuperAdmin\ProgramCategoriesController;
use App\Http\Controllers\api\SuperAdmin\ProgramController;
use App\Http\Controllers\api\SuperAdmin\QuestionController;
use App\Http\Controllers\api\SuperAdmin\Schedule\DateController;
use App\Http\Controllers\api\SuperAdmin\Schedule\MonthController;
use App\Http\Controllers\api\SuperAdmin\Schedule\TypeScheduleController;
use App\Http\Controllers\api\SuperAdmin\ShiftingController;
use App\Http\Controllers\api\SuperAdmin\SupervisorAssignController;
use App\Http\Controllers\api\SuperAdmin\SupplierController;
use App\Http\Controllers\api\SuperAdmin\TimeController;
use App\Http\Controllers\api\SuperAdmin\UsersController;
use App\Http\Controllers\api\SuperAdmin\WebController;
use App\Http\Controllers\api\Supervisor\UserSupervisorController;
use App\Models\BasicInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;






Route::post('/login', [AuthController::class, 'login']);
Route::post('/forget-password', [AuthController::class, 'forget']);
Route::patch('/change-password', [AuthController::class, 'changepas']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/months', [MonthController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'activity'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::patch('/profile/update/{id}', [CrudProfileController::class, 'update']);
    Route::post('/profile/image', [CrudProfileController::class, 'image']);
    Route::get('/send', [OtpController::class, 'sendforchangepass']);
});


Route::post('/user', [UsersController::class, 'store'])->name('super.admin.user.store')->middleware(['auth:sanctum', 'activity', 'super_admin']);
Route::get('/user/pdf', [UsersController::class, 'alluserdownloadpdf'])->name('user.all.download.pdf')->middleware(['auth:sanctum', 'activity', 'specific']);
Route::patch('/user/{id}', [UsersController::class, 'update'])->name('super.admin.user.update')->middleware(['auth:sanctum', 'activity', 'super_admin']);
Route::delete('/user/{id}', [UsersController::class, 'destroy'])->name('super.admin.user.delete')->middleware(['auth:sanctum', 'activity', 'super_admin']);
Route::patch('/user/status/{id}', [UsersController::class, 'status'])->name('super.admin.user.status')->middleware(['auth:sanctum', 'activity', 'super_admin']);
Route::patch('/user/contract/{id}', [UsersController::class, 'updatecontract'])->name('user.contract.update')->middleware(['auth:sanctum', 'activity', 'specific']);
Route::patch('/user/{id}/additional', [UsersController::class, 'additional'])->name('super.admin.user.update.additional')->middleware(['auth:sanctum', 'activity', 'super_admin']);
Route::post('/user/{id}/contract', [UsersController::class, 'newcontract'])->name('user.contract.store')->middleware(['auth:sanctum', 'activity', 'specific']);
Route::get('/user/{id}/pdf', [UsersController::class, 'userdownloadpdf'])->name('user.download.pdf')->middleware(['auth:sanctum', 'activity', 'specific']);
Route::delete('/user/delete/{id}', [UsersController::class, 'deletecontract'])->name('user.contract.delete')->middleware(['auth:sanctum', 'activity', 'specific']);

Route::middleware(['auth:sanctum', 'activity', 'super_admin'])->group(function () {
    Route::get('/webs', [WebController::class, 'index'])->name('super.admin.web.index');
    Route::post('/web', [WebController::class, 'store']);
    Route::patch('/web/{id}', [WebController::class, 'update']);
    Route::delete('/web/{id}', [WebController::class, 'destroy']);

    Route::get('/apis', [ApiController::class, 'index'])->name('super.admin.api.index');
    Route::post('/api', [ApiController::class, 'store']);
    Route::patch('/api/{id}', [ApiController::class, 'update']);
    Route::delete('/api/{id}', [ApiController::class, 'destroy']);

    Route::get('/divisions', [DivisionController::class, 'index'])->name('super.admin.division.index');
    Route::post('/division', [DivisionController::class, 'store'])->name('super.admin.division.store');
    Route::patch('/division/{id}', [DivisionController::class, 'update'])->name('super.admin.division.update');
    Route::delete('/division/{id}', [DivisionController::class, 'destroy'])->name('super.admin.division.delete');

    Route::get('/areas', [AreaController::class, 'index'])->name('super.admin.area.index');
    Route::post('/area', [AreaController::class, 'store'])->name('super.admin.area.store');
    Route::patch('/area/{id}', [AreaController::class, 'update'])->name('super.admin.area.update');
    Route::delete('/area/{id}', [AreaController::class, 'destroy'])->name('super.admin.area.delete');

    Route::get('/positions/{division}', [PositionController::class, 'index'])->name('super.admin.position.index');
    Route::post('/position/{slug}', [PositionController::class, 'store'])->name('super.admin.position.store');
    Route::patch('/position/{id}', [PositionController::class, 'update'])->name('super.admin.position.update');
    Route::delete('/position/{id}', [PositionController::class, 'destroy'])->name('super.admin.position.delete');

    Route::get('/supervisor', [SupervisorAssignController::class, 'index'])->name('super.admin.supervisor.index');
    Route::post('/supervisor', [SupervisorAssignController::class, 'store'])->name('super.admin.supervisor.store');
    Route::delete('/supervisor/{id}', [SupervisorAssignController::class, 'destroy'])->name('super.admin.supervisor.delete');

    Route::get('/fulltime', [FullTimeController::class, 'index'])->name('super.admin.fulltime.index');
    Route::post('/fulltime', [FullTimeController::class, 'store'])->name('super.admin.fulltime.store');
    Route::get('/shifting', [ShiftingController::class, 'index'])->name('super.admin.shifting.index');
    Route::post('/shifting', [ShiftingController::class, 'store'])->name('super.admin.shifting.store');
    Route::patch('/time/{id}', [TimeController::class, 'update'])->name('super.admin.time.patch');
    Route::delete('/time/{id}', [TimeController::class, 'destroy'])->name('super.admin.time.delete');

    Route::get('/accesswebs/{id}', [AccessWebController::class, 'index'])->name('super.admin.accessweb.index');
    Route::post('/accessweb/{id}', [AccessWebController::class, 'store'])->name('super.admin.accessweb.store');
    Route::patch('/accessweb/{id}', [AccessWebController::class, 'update'])->name('super.admin.accessweb.update');
    Route::delete('/accessweb/{id}', [AccessWebController::class, 'destroy'])->name('super.admin.accessweb.delete');

    Route::get('/accessapis/{id}', [AccessAPIController::class, 'index'])->name('super.admin.accessapi.index');
    Route::post('/accessapi/{id}', [AccessAPIController::class, 'store'])->name('super.admin.accessapi.store');
    Route::patch('/accessapi/{id}', [AccessAPIController::class, 'update'])->name('super.admin.accessapi.update');
    Route::delete('/accessapi/{id}', [AccessAPIController::class, 'destroy'])->name('super.admin.accessapi.delete');

    Route::get('/supplies', [SupplierController::class, 'index'])->name('super.admin.supplier.index');
    Route::post('/supplier', [SupplierController::class, 'store'])->name('super.admin.supplier.store');
    Route::patch('/supplier/{id}', [SupplierController::class, 'update'])->name('super.admin.supplier.update');
    Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('super.admin.supplier.delete');

    Route::get('/questions', [QuestionController::class, 'index'])->name('super.admin.question.index');
    Route::post('/question', [QuestionController::class, 'store'])->name('super.admin.question.store');
    Route::patch('/question/{id}', [QuestionController::class, 'update'])->name('super.admin.question.update');
    Route::delete('/question/{id}', [QuestionController::class, 'destroy'])->name('super.admin.question.delete');

    Route::get('/methodes', [MethodeBookingController::class, 'index'])->name('super.admin.methode.booking.index');
    Route::post('/methode', [MethodeBookingController::class, 'store'])->name('super.admin.methode.booking.store');
    Route::patch('/methode/{id}', [MethodeBookingController::class, 'update'])->name('super.admin.methode.booking.update');
    Route::delete('/methode/{id}', [MethodeBookingController::class, 'destroy'])->name('super.admin.methode.booking.delete');

    Route::get('/programs', [ProgramController::class, 'index'])->name('super.admin.program.index');
    Route::post('/program', [ProgramController::class, 'store'])->name('super.admin.program.store');
    Route::patch('/program/{id}', [ProgramController::class, 'update'])->name('super.admin.program.update');
    Route::delete('/program/{id}', [ProgramController::class, 'destroy'])->name('super.admin.program.delete');

    Route::get('/programcategories', [ProgramCategoriesController::class, 'index'])->name('super.admin.program.category.index');
    Route::post('/programcategory', [ProgramCategoriesController::class, 'store'])->name('super.admin.program.category.store');
    Route::patch('/programcategory/{id}', [ProgramCategoriesController::class, 'update'])->name('super.admin.program.category.update');
    Route::delete('/programcategory/{id}', [ProgramCategoriesController::class, 'destroy'])->name('super.admin.program.category.delete');

    Route::get('/contracts', [ContractController::class, 'index'])->name('super.admin.contract.index');
    Route::post('/contract', [ContractController::class, 'store'])->name('super.admin.contract.store');
    Route::patch('/contract/{id}', [ContractController::class, 'update'])->name('super.admin.contract.update');
    Route::delete('/contract/{id}', [ContractController::class, 'destroy'])->name('super.admin.contract.delete');

    Route::get('/pools', [PoolController::class, 'index'])->name('super.admin.pool.index');
    Route::post('/pool', [PoolController::class, 'store'])->name('super.admin.pool.store');
    Route::patch('/pool/{id}', [PoolController::class, 'update'])->name('super.admin.pool.update');
    Route::delete('/pool/{id}', [PoolController::class, 'destroy'])->name('super.admin.pool.delete');

    Route::get('/mammals', [MamalController::class, 'index'])->name('super.admin.mamal.index');
    Route::post('/mammal', [MamalController::class, 'store'])->name('super.admin.mamal.store');
    Route::patch('/mammal/{id}', [MamalController::class, 'update'])->name('super.admin.mamal.update');
    Route::delete('/mammal/{id}', [MamalController::class, 'destroy'])->name('super.admin.mamal.delete');
});

Route::middleware(['auth:sanctum', 'activity', 'general'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('general.notification.index');
    Route::post('/months', [MonthController::class, 'index'])->name('general.months.schedule');
    Route::get('/absen', [AbsenController::class, 'index'])->name('general.absen.index');
    Route::get('/user/{id}', [UsersController::class, 'show'])->name('user.show');
    Route::get('/reschedules', [ScheduleController::class, 'index'])->name('general.reschedules');
    Route::get('/user/{id}/contract', [UsersController::class, 'contracts'])->name('user.contract.index');
});

Route::middleware(['auth:sanctum', 'activity', 'specific'])->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('user.index');
    Route::post('/month', [MonthController::class, 'store'])->name('specific.months.generate');
    Route::delete('/month/{id}', [MonthController::class, 'destroy'])->name('specific.months.delete');
    Route::post('/absen', [AbsenController::class, 'store'])->name('specific.absen.store');
    Route::patch('/absen/{id}', [AbsenController::class, 'update'])->name('specific.absen.update');
    Route::delete('/absen/{id}', [AbsenController::class, 'destroy'])->name('specific.absen.delete');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('specific.schedule.create');
    Route::post('/reschedule', [ScheduleController::class, 'store'])->name('specific.reschedule.create');
    Route::post('/schedule/download', [ScheduleController::class, 'download'])->name('specific.schedule.download');

    //secuirty
    Route::get('/basics', [BasicInformationController::class, 'index'])->name('specific.basics.information.daily');
    Route::post('/basic', [BasicInformationController::class, 'store'])->name('specific.basics.information.daily.create');
    Route::patch('/basic/{id}', [BasicInformationController::class, 'update'])->name('specific.basics.information.daily.update');
    Route::delete('/basic/{id}', [BasicInformationController::class, 'destroy'])->name('specific.basics.information.daily.delete');
    Route::patch('/basic/{id}/done', [BasicInformationController::class, 'done'])->name('specific.basics.information.daily.done');

    Route::get('/patrols', [SecuirtyDailyController::class, 'index'])->name('specific.patrol.index');
    Route::post('/patrol', [SecuirtyDailyController::class, 'store'])->name('specific.patrol.store');
    Route::get('/patrol/{basic}', [SecuirtyDailyController::class, 'show'])->name('specific.patrol.show');
    Route::patch('/patrol/{id}', [SecuirtyDailyController::class, 'update'])->name('specific.patrol.update');
    Route::delete('/patrol/{id}', [SecuirtyDailyController::class, 'destroy'])->name('specific.patrol.delete');

    Route::get('/visitors', [SecurityVisitorController::class, 'index'])->name('specific.security.visitor.index');
    Route::post('/visitor', [SecurityVisitorController::class, 'store'])->name('specific.security.visitor.store');
    Route::patch('/visitor/{id}', [SecurityVisitorController::class, 'update'])->name('specific.security.visitor.update');
    Route::delete('/visitor/{id}', [SecurityVisitorController::class, 'destroy'])->name('specific.security.visitor.delete');

    Route::get('/bookings', [BookingController::class, 'index'])->name('specific.booking.index');
    Route::post('/booking', [BookingController::class, 'store'])->name('specific.booking.store');
    Route::patch('/booking/{id}', [BookingController::class, 'update'])->name('specific.booking.update');
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('specific.booking.delete');

    Route::get('/incidents', [IncidentController::class, 'index'])->name('specific.incident.report.index');
    Route::post('/incident', [IncidentController::class, 'store'])->name('specific.incident.report.store');
    Route::patch('/incident/{id}', [IncidentController::class, 'update'])->name('specific.incident.report.update');
    Route::delete('/incident/{id}', [IncidentController::class, 'destroy'])->name('specific.incident.report.delete');

    Route::get('/logistics', [LogisticController::class, 'index'])->name('specific.logistic.index');
    Route::post('/logistic', [LogisticController::class, 'store'])->name('specific.logistic.store');
    Route::patch('/logistic/{id}', [LogisticController::class, 'update'])->name('specific.logistic.update');
    Route::delete('/logistic/{id}', [LogisticController::class, 'destroy'])->name('specific.logistic.delete');

    Route::get('/deliveries', [DeliveryController::class, 'index'])->name('specific.delivery.index');
    Route::post('/delivery', [DeliveryController::class, 'store'])->name('specific.security.delivery.store');
    Route::patch('/delivery/{id}', [DeliveryController::class, 'update'])->name('specific.security.delivery.update');
    Route::delete('/delivery/{id}', [DeliveryController::class, 'destroy'])->name('specific.security.delivery.delete');

    Route::get('/sales', [SalesController::class, 'index'])->name('specific.sales.index');
    Route::post('/sale', [SalesController::class, 'store'])->name('specific.sales.store');
    Route::patch('/sale/{id}', [SalesController::class, 'update'])->name('specific.sales.update');
    Route::delete('/sale/{id}', [SalesController::class, 'destroy'])->name('specific.sales.delete');

    Route::get('/consumptions', [ConsumptionController::class, 'index'])->name('specific.consumption.index');
    Route::post('/consumption', [ConsumptionController::class, 'store'])->name('specific.fishroom.consumption.store');
    Route::patch('/consumption/{id}', [ConsumptionController::class, 'update'])->name('specific.fishroom.consumption.update');
    Route::delete('/consumption/{id}', [ConsumptionController::class, 'destroy'])->name('specific.fishroom.consumption.delete');

    Route::get('/healthchecks', [HealthCheckController::class, 'index'])->name('specific.healthcheck.index');
    Route::post('/healthcheck', [HealthCheckController::class, 'store'])->name('specific.veterinary.healthcheck.store');
    Route::patch('/healthcheck/{id}', [HealthCheckController::class, 'update'])->name('specific.veterinary.healthcheck.update');
    Route::delete('/healthcheck/{id}', [HealthCheckController::class, 'destroy'])->name('specific.veterinary.healthcheck.delete');

    Route::get('/waterqualities', [WaterQualityController::class, 'index'])->name('specific.waterquality.index');
    Route::post('/waterquality', [WaterQualityController::class, 'store'])->name('specific.sustainable.waterquality.store');
    Route::patch('/waterquality/{id}', [WaterQualityController::class, 'update'])->name('specific.sustainable.waterquality.update');
    Route::delete('/waterquality/{id}', [WaterQualityController::class, 'destroy'])->name('specific.sustainable.waterquality.delete');

    Route::get('/poolareas', [PoolAreaController::class, 'index'])->name('specific.poolarea.index');
    Route::post('/poolarea', [PoolAreaController::class, 'store'])->name('specific.trainer.poolarea.store');
    Route::patch('/poolarea/{id}', [PoolAreaController::class, 'update'])->name('specific.trainer.poolarea.update');
    Route::delete('/poolarea/{id}', [PoolAreaController::class, 'destroy'])->name('specific.trainer.poolarea.delete');

    Route::get('/orders', [OrderController::class, 'index'])->name('specific.order.index');
    Route::post('/order', [OrderController::class, 'store'])->name('specific.order.store');
    Route::patch('/order/{id}', [OrderController::class, 'update'])->name('specific.order.update');
    Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('specific.order.delete');
    Route::patch('/order/{id}/confirm', [OrderController::class, 'update'])->name('specific.order.confirm');
    Route::patch('/order/{id}/arrived', [OrderController::class, 'update'])->name('specific.order.arrived');

    Route::post('/notification', [NotificationController::class, 'store'])->name('specific.notification.store');
    Route::patch('/notification/{id}', [NotificationController::class, 'update'])->name('specific.notification.update');
    Route::delete('/notification/{id}', [NotificationController::class, 'destroy'])->name('specific.notification.delete');

    Route::get('/mammalreports', [MamalReportController::class, 'index'])->name('specific.mammal.report.index');
    Route::post('/mammalreport', [MamalReportController::class, 'store'])->name('specific.mammal.report.store');
    Route::patch('/mammalreport/{id}', [MamalReportController::class, 'update'])->name('specific.mammal.report.update');
    Route::delete('/mammalreport/{id}', [MamalReportController::class, 'destroy'])->name('specific.mammal.report.delete');
    Route::post('/mammalreport/{id}/vet', [MamalReportController::class, 'vetstore'])->name('specific.mammal.report.vet.store');
    Route::patch('/mammalreport/{id}/vet', [MamalReportController::class, 'update'])->name('specific.mammal.report.vet.update');

    Route::get('/diets', [DietController::class, 'index'])->name('specific.diet.index');
    Route::post('/diet', [DietController::class, 'store'])->name('specific.diet.store');
    Route::patch('/diet/{id}', [DietController::class, 'update'])->name('specific.diet.update');
    Route::delete('/diet/{id}', [DietController::class, 'destroy'])->name('specific.diet.delete');
    Route::patch('/diet/{id}/approve', [DietController::class, 'approve'])->name('specific.diet.approve');
    Route::patch('/diet/{id}/execute', [DietController::class, 'execute'])->name('specific.diet.execute');

    Route::get('/workorders', [WorkorderController::class, 'index'])->name('specific.work.order.index');
    Route::post('/workorder', [WorkorderController::class, 'store'])->name('specific.work.order.store');
    Route::patch('/workorder/{id}', [WorkorderController::class, 'update'])->name('specific.work.order.update');
    Route::delete('/workorder/{id}', [WorkorderController::class, 'destroy'])->name('specific.work.order.delete');
    Route::patch('/workorder/{id}/confirm', [WorkorderController::class, 'update'])->name('specific.work.order.confirm');
});

Route::middleware(['auth:sanctum', 'activity', 'super_admin'])->prefix('priority-first')->group(function () {

    Route::get('/dates', [DateController::class, 'index']);
});
