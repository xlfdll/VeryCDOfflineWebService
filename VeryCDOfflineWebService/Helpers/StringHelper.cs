using System;

namespace VeryCDOfflineWebService.Helpers
{
	public class StringHelper
	{
		public static String GetHumanReadableSizeString(Int64 size, Int32 precision)
		{
			Double length = size;

			if (size != 0L)
			{
				Int32 order = Convert.ToInt32(Math.Floor(Math.Log(length, 1024)));

				length /= Math.Pow(1024, order);

				return length.ToString("F" + precision.ToString()) + " " + StringHelper.ByteAbbreviations[order];
			}
			else
			{
				return length.ToString("F" + precision.ToString()) + " " + StringHelper.ByteAbbreviations[0];
			}
		}

		private static String[] ByteAbbreviations = { "B", "KB", "MB", "GB" };
	}
}