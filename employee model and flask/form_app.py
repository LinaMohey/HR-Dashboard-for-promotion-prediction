from flask import Flask, jsonify, request
import pandas as pd
import pickle
from flask_cors import CORS
import pickle

app_form= Flask(__name__, static_url_path='/static')
CORS(app_form, resources={r"/*": {"origins": "*"}})

model=pickle.load(open('HRmodel.pkl','rb'))


department_mapping = {
    'Sales & Marketing':1,
    'Operations':2,
    'Technology':3,
    'Analytics':4,
    'R&D':5,
    'Procurement':6,
    'Finance':7,
    'HR':8,
    'Legal':9
}

region_mapping = {
    'region_1':1,
    'region_2':2,
    'region_3':3,
    'region_4':4,
    'region_5':5,
    'region_6':6,
    'region_7':7,
    'region_8':8,
    'region_9':9,
    'region_10':10,
    'region_11':11,
    'region_12':12,
    'region_13':13,
    'region_14':14,
    'region_15':15,
    'region_16':16,
    'region_17':17,
    'region_18':18,
    'region_19':19,
    'region_20':20,
    'region_21':21,
    'region_22':22,
    'region_23':23,
    'region_24':24,
    'region_25':25,
    'region_26':26,
    'region_27':27,
    'region_28':28,
    'region_29':29,
    'region_30':30,
    'region_31':31,
    'region_32':32,
    'region_33':33,
    'region_34':34
}

education_mapping = {
    'Masters':1,
    'Bachelors':2,
    'Below Secondary':3,
}

gender_mapping ={
    'Male':1,
'Female':0
}

recruitment_channel_mapping = {
    'sourcing':1,
    'other':2,
    'referred':3
}

awards_won_mapping = {
    'Yes':1,
    'No':0
}

def user_input_features():
    department_feature = request.args.get('department')
    department = department_mapping[department_feature]

    region_feature= request.args.get('region')
    region = region_mapping[region_feature]

    education_feature = request.args.get('education')
    education = education_mapping[education_feature]

    gender_feature = request.args.get('gender')
    gender = gender_mapping[gender_feature]

    recruitment_channel_feature = request.args.get('recruitment_channel')
    recruitment_channel = recruitment_channel_mapping.get(recruitment_channel_feature)

    average_montly_hours = int(request.args.get('average_montly_hours'))

    no_of_trainings = int(request.args.get('no_of_trainings'))

    age = int(request.args.get('age'))

    previous_year_rating = int(request.args.get('previous_year_rating'))

    length_of_service = int(request.args.get('length_of_service'))

    awards_won_feature = request.args.get('awards_won')
    awards_won = awards_won_mapping[awards_won_feature]

    avg_training_score = int(request.args.get('avg_training_score'))

    data = {'department':department,
            'region':region,
            'education':education,
            'gender':gender,
            'recruitment_channel':recruitment_channel,
            'no_of_trainings':no_of_trainings,
            'age': age,
            'previous_year_rating': previous_year_rating,
            'length_of_service': length_of_service,
            'awards_won': awards_won,
            'avg_training_score': avg_training_score,
            'average_montly_hours':average_montly_hours }

    features = pd.DataFrame(data,index = [0])
    return features

@app_form.route('/pred', methods=['GET'])
def pred():
    input_df = user_input_features()
    prediction = model.predict(input_df)
    prediction_probability = model.predict_proba(input_df)[:,1]
    probability_result = "{0:.2f}%".format(prediction_probability[0] * 100)

    if prediction[0] == 0:
        text = 'Sorry, you are not eligible for promotion'

        if input_df['gender'].iloc[0] == 0:
         image_url = request.host_url + 'static/NoFemale46.gif'
        else:
         image_url = request.host_url + 'static/NoMale2.gif'
    else:
        text = 'Great, you are eligible for promotion'
        if input_df['gender'].iloc[0] == 0:
         image_url = request.host_url + 'static/Powerful.gif'
        else:
         image_url = request.host_url + 'static/LeaderMale.gif'


    return jsonify({
        "prediction_text": text,
        "image_url": image_url,
        "prob_result": probability_result,

    })

if __name__ == '__main__':

 app_form.run(debug=True,port=5001)
