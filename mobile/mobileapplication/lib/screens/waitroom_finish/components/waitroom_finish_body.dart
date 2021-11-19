import 'dart:math';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:mobileapplication/components/constants.dart';
import 'package:mobileapplication/components/rounded_button.dart';
import 'package:mobileapplication/models/getroom/ans.dart';
import 'package:mobileapplication/models/getroom/play.dart';
import 'package:mobileapplication/models/getroom/player.dart';
import 'package:mobileapplication/models/getroom/question.dart';
import 'package:mobileapplication/models/getroom/room.dart';
import 'package:page_indicator/page_indicator.dart';

class WaitRoomFinishBody extends StatelessWidget {
  final Room room;
  final String iduser;

  const WaitRoomFinishBody({
    Key? key,
    required this.room,
    required this.iduser,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    Player? player = _getPlayerById(room.players, iduser);
    if (player != null) {
      var correctNumber = _getCorrectNumber(player.play);
      var incorrectNumer = room.data.length - correctNumber;
      return Container(
        width: size.width,
        decoration: BoxDecoration(color: Colors.black),
        padding: const EdgeInsets.symmetric(horizontal: 10),
        child: SafeArea(
          child: ListView(
            children: [
              _nameRow(player.name),
              _fourSummaryItems(size, "$correctNumber", "$incorrectNumer"),
              Column(
                children: _questionView(room.data, player.play),
              )
            ],
          ),
        ),
      );
    }
    return Text('Something was wrong');
  }

  Widget _nameRow(String nameuser) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 10),
      decoration: BoxDecoration(
        border: Border.all(color: borderColor, width: 2),
        borderRadius: BorderRadius.circular(10),
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Text(
            nameuser,
            style: const TextStyle(
              fontSize: 20,
              color: Colors.white,
              fontWeight: FontWeight.bold,
            ),
          ),
          CircleAvatar(
            radius: 30,
            backgroundColor: Colors.deepOrangeAccent,
            child: ClipOval(
              child: Image.asset(
                'assets/images/img0.jpg',
                fit: BoxFit.cover,
                width: 100.0,
                height: 100.0,
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _summaryItem(Size size, String image, String titlte, String des) {
    return Container(
      margin: const EdgeInsets.symmetric(vertical: 5),
      width: size.width * 0.45,
      height: 100,
      decoration: BoxDecoration(
        image: DecorationImage(
          image: AssetImage(image),
          fit: BoxFit.fill,
        ),
        borderRadius: BorderRadius.circular(10),
      ),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Text(
            titlte,
            style: const TextStyle(
              color: Colors.white,
              fontWeight: FontWeight.bold,
              fontSize: 30,
            ),
          ),
          Text(
            des,
            style: const TextStyle(
              color: Colors.white,
            ),
          ),
        ],
      ),
    );
  }

  Widget _fourSummaryItems(Size size, String correct, String incorrect) {
    return Container(
      margin: const EdgeInsets.only(top: 15),
      width: size.width,
      child: Column(
        children: [
          const Text(
            'Số liệu thống kê hiệu suất',
            style: TextStyle(color: Colors.white),
          ),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Column(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  _summaryItem(
                      size, 'assets/images/img0.jpg', correct, 'Chính xác'),
                ],
              ),
              Column(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  _summaryItem(size, 'assets/images/img0.jpg', incorrect,
                      'Không chính xác'),
                ],
              )
            ],
          )
        ],
      ),
    );
  }

  List<Widget> _questionView(
      List<Question> questions, List<Play> playedByUser) {
    List<Widget> childs = [];
    for (final ques in questions) {
      var play =
          playedByUser.singleWhere((element) => element.idques == ques.idques);
      var ansview = Container(
        margin: const EdgeInsets.symmetric(vertical: 5),
        padding: const EdgeInsets.all(10),
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.circular(10),
        ),
        child: Column(
          children: [
            Text(
              ques.valueques,
              textAlign: TextAlign.left,
            ),
            const Divider(
              height: 10,
            ),
            Column(
              children: _answerView(ques.ans, play, ques.correct),
            )
          ],
        ),
      );
      childs.add(ansview);
    }
    return childs;
  }

  List<Widget> _answerView(List<Ans> anss, Play play, String answerCorrect) {
    List<Widget> childs = [];
    for (final ans in anss) {
      var ansview = Container(
        padding: const EdgeInsets.symmetric(vertical: 2),
        child: Row(
          children: [
            Container(
              width: 20,
              height: 20,
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                color: ans.idans == play.idans && ans.idans == answerCorrect
                    ? correctColor
                    : ans.idans == play.idans && play.idans != "null"
                        ? inCorrectColor
                        : ans.idans == answerCorrect && play.idans != "null"
                            ? correctColor
                            : Color(0xFFAAAAAA),
              ),
            ),
            const Padding(padding: EdgeInsets.all(5)),
            Text(ans.valueans),
          ],
        ),
      );
      childs.add(ansview);
    }
    return childs;
  }

  Player? _getPlayerById(List<Player> players, String iduser) {
    for (final player in players) {
      if (player.id == iduser) {
        return player;
      }
    }
    return null;
  }

  int _getCorrectNumber(List<Play> plays) {
    int correct = 0;
    if (plays != null) {
      for (final play in plays) {
        if (play.istrue) {
          correct++;
        }
      }
    }
    return correct;
  }
}
