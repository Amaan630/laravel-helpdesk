# Steps to complete after installation:

## Add routes to `api.php`

```
// messages
Route::get('/messages', [ApiMessageController::class, 'index'])->name('api.messages.index');
Route::post('/messages', [ApiMessageController::class, 'store'])->name('api.messages.store');
Route::post('/messages/react', [ApiMessageController::class, 'react'])->name('api.messages.react');
```

## Add routes to `web.php`

```
Route::middleware([
    'auth:sanctum',
    'verified',
    config('jetstream.auth_session'),
    'role.admin',
])->group(function () {
    // Admin Helpdesk
    Route::get('/admin/helpdesk', [HelpdeskAdminController::class, 'index'])->name('admin.helpdesk');
    Route::get('/admin/api/conversations', [HelpdeskAdminController::class, 'getConversations']);
    Route::get('/admin/api/messages', [HelpdeskAdminController::class, 'getMessages']);
    Route::post('/admin/api/messages', [HelpdeskAdminController::class, 'sendMessage']);
});
```

## Update `app/Middleware/CheckAdminRole.php` if necessary

(based on how you control who is an admin or not)

## Add to `app/Http/Kernel.php`

```
// in the `protected $middlewareAliases = [` section

'role.admin' => \App\Http\Middleware\CheckAdminRole::class,
```
