using Microsoft.AspNetCore.Builder;
using Microsoft.AspNetCore.Hosting;
using Microsoft.EntityFrameworkCore;
using Microsoft.Extensions.Configuration;
using Microsoft.Extensions.DependencyInjection;

using VeryCDOfflineWebService.Data;
using VeryCDOfflineWebService.Models;

namespace VeryCDOfflineWebService
{
	public class Startup
	{
		public Startup(IHostingEnvironment env)
		{
			this.Configuration = new ConfigurationBuilder()
				.SetBasePath(env.ContentRootPath)
				.AddJsonFile("appsettings.json")
				.Build();
		}

		public IConfigurationRoot Configuration { get; }

		// This method gets called by the runtime. Use this method to add services to the container.
		// For more information on how to configure your application, visit https://go.microsoft.com/fwlink/?LinkID=398940
		public void ConfigureServices(IServiceCollection services)
		{
			services.AddMvc();
			services.Configure<AppSettings>(this.Configuration);
			services.AddEntityFrameworkSqlite().AddDbContext<MainDataContext>
				(
					options =>
					{
						options.UseSqlite(this.Configuration["ConnectionString"]);
					}
				);
		}

		// This method gets called by the runtime. Use this method to configure the HTTP request pipeline.
		public void Configure(IApplicationBuilder app, IHostingEnvironment env, IApplicationLifetime applicationLifetime)
		{
			if (env.IsDevelopment())
			{
				app.UseDeveloperExceptionPage();
			}
			
			app.UseStaticFiles();
			app.UseStatusCodePages();
			app.UseMvcWithDefaultRoute();
		}
	}
}