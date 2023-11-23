import requests
import csv

base_url = "https://app.vantetider.se/spa/1.1/rest/phone/trends"

measurementMonth = "Hösten"
measurementYear = 2023
regionId = 13

output = {
    "Alla regioner": {},
    "Västra Götalandsregionen": {}
}

while (measurementYear):
    res = requests.get(base_url, params={
        "measurementMonth": measurementMonth,
        "measurementYear": measurementYear,
        "regionId": regionId,
        "showNationell": "true"
    })

    print(res)

    json = res.json()

    newYear = json["startDate"][0:4]
    print(newYear)
    if measurementYear != newYear:
        measurementYear = newYear
    else:
        break
    print(measurementYear)

    if json["series"] == []:
        print("No more data")
        break

    for series in json["series"]:
        for data in series["data"]:
            output[series["name"]][data["name"]] = data


for region in output.keys():
    with open(f'{region}.csv', "w", encoding="UTF8") as file:
        writer = csv.writer(file)
        # Write header
        writer.writerow(["name", "måluppfyllelse", "recived", "answered"])
        for row in output[region].values():
            writer.writerow(row.values())