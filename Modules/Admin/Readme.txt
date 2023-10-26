1. Make Admin model
2. rewrite response Dashboard->user
3. Sua App\Http\Middleware;

            if ($request->is('admin/*')) {
                return route('admin.login');
            }

4. Sua login blade
resources/views/auth/login.blade.php