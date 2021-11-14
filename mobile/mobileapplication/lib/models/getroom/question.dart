import 'ans.dart';

class Question {
  final String _id;
  final String idques;
  final String index;
  final String valueques;
  final List<Ans> ans;
  final String correct;
  final String time;

  const Question(this._id, this.idques, this.index, this.valueques, this.ans,
      this.correct, this.time);

  Question.fromJson(Map<String, dynamic> json)
      : _id = json['_id'] ?? "",
        idques = json['idques'],
        index = json['index'],
        valueques = json['valuesques'],
        ans = (json['ans'] as List).map((e) => Ans.fromJson(e)).toList(),
        correct = json['correct'],
        time = json['time'];
}
